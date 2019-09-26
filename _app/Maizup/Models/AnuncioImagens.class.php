<?php

/**
 * Description of AnuncioImagens
 * @author Dheo
 */
class AnuncioImagens {

    public static function getCover($id) {
        $read = new Read();
        if ($read->ExeRead('anuncios_img', 'WHERE anuncio_id = :id LIMIT 1', "id={$id}")) {
            return $read->getResult()[0];
        } else {
            return 'uploads/imagem.jpg';
        }
    }

    public static function getImgMedalha($patente) {
        $imagem = [
            '1' => '1.png',
            '2' => '2.png',
            '3' => '3.png',
            '4' => '4.png',
        ];
        if (!empty($patente)):
            return $imagem[$patente];
        else:
            return $patente;
        endif;
    }

    public static function getImagesGallery($id) {
        $read = new Read();
        if ($read->ExeRead('anuncios_img', 'WHERE anuncio_id = :id', "id={$id}")) {
            return $read->getResult();
        } else {
            return 'uploads/imagem.jpg';
        }
    }

}
