<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class MovieApiService
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        // Leemos las credenciales desde config/services.php
        $this->apiKey = config('services.omdb.key');
        $this->baseUrl = config('services.omdb.url');

        // Nos aseguramos de que la URL base esté limpia y termine con "/"
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
    }

    /**
     * Busca películas por título y opcionalmente por año.
     */
    public function search(string $title, ?int $year = null, int $page = 1)
    {
        // Preparamos los parámetros de la petición.
        // El cliente HTTP de Laravel añadirá esto a la URL base.
        // Por ejemplo: http://www.omdbapi.com/?s=Matrix&y=1999&apikey=...
        $params = [
            's' => $title,
            'y' => $year,
            'page' => $page,
        ];

        return $this->makeRequest($params);
    }

    /**
     * Busca una película específica por su ID de IMDb.
     */
    public function findById(string $id)
    {
        $params = [
            'i' => $id,
            'plot' => 'full', // Para obtener la sinopsis completa
        ];

        return $this->makeRequest($params);
    }

    /**
     * Método centralizado para hacer las peticiones a la API.
     * Incluye manejo de errores detallado.
     */
    protected function makeRequest(array $params)
    {
        // Añadimos la API key a todos los requests.
        // y eliminamos parámetros nulos (como el año, si no se proporciona).
        $fullParams = array_filter(array_merge($params, ['apikey' => $this->apiKey]));

        try {
            // Hacemos la llamada HTTP con un timeout de 10 segundos.
            $response = Http::timeout(10)->get($this->baseUrl, $fullParams);

            // Lanza una excepción para errores 4xx o 5xx (ej. 401 Unauthorized si la API key es mala).
            $response->throw();

            $data = $response->json();

            // OMDb a veces responde con 200 OK pero con un error interno.
            if (isset($data['Response']) && $data['Response'] === 'False') {
                return ['error' => $data['Error'] ?? 'Error desconocido de la API.'];
            }

            return $data;

        } catch (ConnectionException $e) {
            // Este error es específico para problemas de red (Firewall, DNS, no hay internet).
            return ['error' => 'Error de Conexión: No se pudo establecer comunicación con el servidor de películas. Revisa tu conexión a internet y la configuración del firewall.'];
        } catch (RequestException $e) {
            // Este error captura respuestas 4xx y 5xx.
            return ['error' => 'Error del Servidor de Películas: La API respondió con un error. (Código: ' . $e->getCode() . ')'];
        }
    }
}