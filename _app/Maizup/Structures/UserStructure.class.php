<?php

/**
 * UserSeeder
 * Retorna o nome dos campos na tabela
 * @author Dheo
 */
class UserStructure {

    public static 
            $id,
            $first_access,
            $secret_key,
            $data_cadastro,
            $nome,
            $sobrenome,
            $usuario,
            $celular,
            $email,
            $senha,
            $cpf,
            $endereco,
            $estado,
            $cidade,
            $pais,
            $nivel,
            $rg_habilitacao,
            $cpf_anexo,
            $verificado,
            $credito,
            $cadastro_liberado,
            $descricao,
            $patente;

    public static  function getId() {
        return self::$id = 'id';
    }

    public static  function getFirst_access() {
        return self::$first_access = 'first_access';
    }

    public static  function getSecret_key() {
        return self::$secret_key = 'secret_key';
    }

    public static  function getData_cadastro() {
        return self::$data_cadastro = 'data_cadastro';
    }

    public static  function getNome() {
        return self::$nome = 'nome';
    }

    public static  function getSobrenome() {
        return self::$sobrenome = 'sobrenome';
    }

    public static  function getUsuario() {
        return self::$usuario = 'usuario';
    }

    public static  function getCelular() {
        return self::$celular = 'celular';
    }

    public static  function getEmail() {
        return self::$email = 'email';
    }

    public static  function getSenha() {
        return self::$senha = 'senha';
    }

    public static  function getCpf() {
        return self::$cpf = 'cpf';
    }

    public static  function getEndereco() {
        return self::$endereco = 'endereco';
    }

    public static  function getEstado() {
        return self::$estado = 'estado';
    }

    public static  function getCidade() {
        return self::$cidade = 'cidade';
    }

    public static  function getPais() {
        return self::$pais = 'pais';
    }

    public static  function getNivel() {
        return self::$nivel = 'nivel';
    }

    public static  function getRg_habilitacao() {
        return self::$rg_habilitacao = 'rg_habilitacao';
    }

    public static  function getCpf_anexo() {
        return self::$cpf_anexo = 'cpf_anexo';
    }

    public static  function getVerificado() {
        return self::$verificado = 'verificado';
    }

    public static  function getCredito() {
        return self::$credito = 'credito';
    }

    public static  function getCadastro_liberado() {
        return self::$cadastro_liberado = 'cadastro_liberado';
    }

    public static  function getDescricao() {
        return self::$descricao = 'descricao';
    }

    public static  function getPatente() {
        return self::$patente = 'patente';
    }

}
