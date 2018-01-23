<?php
use App\Model\Apirest\TblEtiqueta;
use Illuminate\Database\Seeder;

class TblEtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TblEtiqueta::create([
            'id_usuario'                     => 27391
            ,'id_empresa'                    => 11613
            ,'etiqueta_img'                  => "icon-hospedaje"
            ,'etiqueta_nombre'               => "Hospedaje"
            ,'etiqueta_descripcion'          => "Etiqueta descripcion Hospedaje"
            ,'etiqueta_tipo'                 => 1
            ,'etiqueta_tipo_img'             => "icon"
        ]);

          TblEtiqueta::create([
            'id_usuario'                     => 27391
            ,'id_empresa'                    => 11613
            ,'etiqueta_img'                  => "icon-comida"
            ,'etiqueta_nombre'               => "Alimentacion"
            ,'etiqueta_descripcion'          => "Etiqueta descripcion Alimentación"
            ,'etiqueta_tipo'                 => "predeterminadas"
            ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
            'id_usuario'                     => 27391
            ,'id_empresa'                    => 11613
            ,'etiqueta_img'                  => "icon-transporte_publico"
            ,'etiqueta_nombre'               => "Transporte"
            ,'etiqueta_descripcion'          => "Etiqueta descripcion Transporte"
            ,'etiqueta_tipo'                 => "predeterminadas"
            ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
        'id_usuario'                     => 27391
        ,'id_empresa'                    => 11613
        ,'etiqueta_img'                  => "icon-renta_autos"
        ,'etiqueta_nombre'               => "Renta de Autos"
        ,'etiqueta_descripcion'          => "Etiqueta descripcion Renta de Autos"
        ,'etiqueta_tipo'                 => "predeterminadas"
        ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
        'id_usuario'                     => 27391
        ,'id_empresa'                    => 11613
        ,'etiqueta_img'                  => "icon-seminarios"
        ,'etiqueta_nombre'               => "Seminarios o Convenciones"
        ,'etiqueta_descripcion'          => "Etiqueta descripcion Seminarios o Convenciones"
        ,'etiqueta_tipo'                 => "predeterminadas"
        ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
        'id_usuario'                     => 27391
        ,'id_empresa'                    => 11613
        ,'etiqueta_img'                  => "icon-kilometraje"
        ,'etiqueta_nombre'               => "Pago por kilometraje"
        ,'etiqueta_descripcion'          => "Etiqueta descripcion Pago por kilometraje"
        ,'etiqueta_tipo'                 => "predeterminadas"
        ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
        'id_usuario'                     => 27391
        ,'id_empresa'                    => 11613
        ,'etiqueta_img'                  => "icon-transporte_aereo"
        ,'etiqueta_nombre'               => "Renta de Transporte aéreo"
        ,'etiqueta_descripcion'          => "Etiqueta descripcion Renta de Transporte aéreo"
        ,'etiqueta_tipo'                 => "predeterminadas"
        ,'etiqueta_tipo_img'             => "icon"
        ]);

        TblEtiqueta::create([
            'id_usuario'                     => 27391
            ,'id_empresa'                    => 11613
            ,'etiqueta_img'                  => "icon-transporte_terrestre"
            ,'etiqueta_nombre'               => "Renta de Transporte terrestre"
            ,'etiqueta_descripcion'          => "Etiqueta descripcion Renta de Transporte terrestre"
            ,'etiqueta_tipo'                 => "predeterminadas"
            ,'etiqueta_tipo_img'             => "icon"
        ]);
        
        TblEtiqueta::create([
            'id_usuario'                     => 27391
            ,'id_empresa'                    => 11613
            ,'etiqueta_img'                  => "fa fa-address-card"
            ,'etiqueta_nombre'               => "Gastos Extraordinarios"
            ,'etiqueta_descripcion'          => "Se Agrega esta opcion para verificar si existe otro tipo de viatico"
            ,'etiqueta_tipo'                 => "predeterminadas"
            ,'etiqueta_tipo_img'             => "icon"
        ]);


    }
}
