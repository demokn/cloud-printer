<?php

namespace Demokn\CloudPrinter\Gateway;

use Demokn\CloudPrinter\Helper;
use Demokn\CloudPrinter\Machine;
use Psr\Http\Message\ResponseInterface;

class Printcenter365Gateway extends AbstractGateway
{
    protected $endpoint = 'http://open.printcenter.cn:8080';

    protected function getEndpoint(string $uri = ''): string
    {
        if (Helper::isUrl($uri)) {
            return $uri;
        }

        return $this->endpoint.($uri ? ('/'.ltrim($uri, '/')) : '');
    }

    private function buildMachineParams(Machine $machine): array
    {
        return [
            'deviceNo' => $machine->getSerialNumber(),
            'key' => $machine->getSecretKey(),
        ];
    }

    public function queryMachineStatus(Machine $machine): ResponseInterface
    {
        return $this->httpClient->request(
            'POST',
            $this->getEndpoint('queryPrinterStatus'),
            [
                'form_params' => array_merge(
                    $this->buildMachineParams($machine),
                    []
                ),
            ]
        );
    }

    public function sendPrintTask(Machine $machine, string $content, int $times = 1): ResponseInterface
    {
        return $this->httpClient->request(
            'POST',
            $this->getEndpoint('addOrder'),
            [
                'form_params' => array_merge(
                    $this->buildMachineParams($machine),
                    [
                        'printContent' => $content,
                        'times' => $times,
                    ]
                ),
            ]
        );
    }

    public function queryPrintTask(Machine $machine, string $orderNo): ResponseInterface
    {
        return $this->httpClient->request(
            'POST',
            $this->getEndpoint('queryOrder'),
            [
                'form_params' =>
                    array_merge(
                        $this->buildMachineParams($machine),
                        [
                            'orderindex' => $orderNo,
                        ]
                    ),
            ]
        );
    }
}
