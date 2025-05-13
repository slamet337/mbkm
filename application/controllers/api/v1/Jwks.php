<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jwks extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('JwtEdDSA', null, 'JwtEdDSA');
    }

    public function index_get()
    {
        try {
            $jwk = $this->generateJwk();
            $this->response([
                'keys' => [$jwk]
            ], RestController::HTTP_OK);
        } catch (Exception $e) {
            $this->response([
                'success' => false,
                'message' => 'Failed to generate JWKS: ' . $e->getMessage()
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function generateJwk()
    {
        $publicKeyRaw = base64_decode($this->config->item('public_key'));

        // Convert ke base64url
        $x = rtrim(strtr(base64_encode($publicKeyRaw), '+/', '-_'), '=');

        return [
            'kty' => 'OKP',
            'crv' => 'Ed25519',
            'x'   => $x,
            'alg' => 'EdDSA',
            'use' => 'sig',
            'kid' => $this->calculateKid($publicKeyRaw),
        ];
    }

    private function calculateKid($publicKeyRaw)
    {
        // KID dihitung dari SHA-256 hash public key (bisa bebas juga)
        return rtrim(strtr(base64_encode(hash('sha256', $publicKeyRaw, true)), '+/', '-_'), '=');
    }
}
