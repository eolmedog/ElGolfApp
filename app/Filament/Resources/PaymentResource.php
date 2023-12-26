<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Mail\LowHoursEmail;
use App\Models\PaymentModel;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = PaymentModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')->required()->numeric()->prefix('$')->label('Monto'),
                Forms\Components\TextInput::make('description')->maxLength(255)->label('Descripción'),
                Forms\Components\TextInput::make('hours')->numeric()->label('Horas'),
                Forms\Components\Select::make('cliente_id')->relationship('cliente', 'email')->required(),
                Forms\Components\Select::make('payment_status')->options([
                    'paid' => 'Pagado',
                    'pending' => 'Pendiente',
                    'canceled' => 'Cancelado',
                ])->default('pending')->label('Estado Pago'),
                Forms\Components\Select::make('payment_method')->options([
                    'cash' => 'Efectivo',
                    'transfer' => 'Transferencia',
                    'card' => 'Tarjeta',
                    'virtualpos' => 'Virtual POS',
                ])->required()->default('cash')->label('Metodo Pago'),
                Forms\Components\Select::make('invoice_or_receipt')->options([
                    'invoice' => 'Factura',
                    'receipt' => 'Boleta',
                ])->required()->default('invoice')->label('Factura o Boleta'),
                Forms\Components\Select::make('document_created')->options([
                    true => 'Sí',
                    false => 'No',
                ])->required()->default(false)->label('Documento Creado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.email'),
                Tables\Columns\TextColumn::make('amount')->money('CLP')->label('Monto'),
                Tables\Columns\TextColumn::make('description')->label('Descripción'),
                Tables\Columns\TextColumn::make('hours')->label('Horas'),
                Tables\Columns\TextColumn::make('payment_status')->label('Estado Pago'),
                Tables\Columns\TextColumn::make('payment_method')->label('Metodo Pago'),
                Tables\Columns\TextColumn::make('invoice_or_receipt')->label('Factura o Boleta'),
                Tables\Columns\TextColumn::make('document_created')->label('Documento Creado'),
                Tables\Columns\TextColumn::make('payment_date')->label('Fecha Pago'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('resendEmail')->label('Reenviar Email')->icon('heroicon-o-envelope')->action(function($record){
                    $email=$record->cliente->email;
                    $internal_code=$record->internal_code;
                    $first_name=$record->first_name;
                    $last_name=$record->last_name;
                    Mail::to($email)->queue(new LowHoursEmail($internal_code,$first_name,$last_name));
                })->requiresConfirmation('¿Esta seguro de reenviar el email?')->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
    public static function getLabel(): string
    {
        return 'Pagos';
    }
}
