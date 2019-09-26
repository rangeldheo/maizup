<?php

/**
 * AnuncioFormatter
 * @author Dheo
 */
class AnuncioFormatter {

    public static function formatList($list) {
        $formatter = null;
        foreach ($list as $key => $value) {
            $aux = $value;
            $aux[AnuncioStructure::getDescricao()] = substr($value[AnuncioStructure::getDescricao()], 0, 100);
            $aux[AnuncioStructure::getValor()] = number_format(floatval($value[AnuncioStructure::getValor()]), 2, ',', '.');
            $parcela = floatval($value['valor']) / 12;          
            $aux['parcelamento'] = '12x de R$' . number_format(floatval($parcela), 2, ',', '.');
            $quantidade = ($value['quantidade'] > 1) ? $value['quantidade'] . ' disponíveis' : $value['quantidade'] . ' disponível';
            $aux['quantidade_formated'] = $quantidade;
            $formatter[] = $aux;
        }
        //var_dump($formatter);die;
        return $formatter;
    }

    public static function formatAnuncios($lista) {
        if ($lista) {
            foreach ($lista as $indice => $registro) {
                $objUser = new User();
                $registro['cover'] = 'https://www.maizup.com.br/uploads/anuncios/087344deb98ffbf3691b70daac822c14.png';
                $anunciosPatrocinados[] = array_merge($objUser->show($registro[AnuncioStructure::getId_membro()]), $registro);
            }
            return self::formatList($anunciosPatrocinados);
        } else {
            return null;
        }
    }

}
