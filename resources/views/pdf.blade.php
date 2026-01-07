<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>LISTADO DE COBRO (CON NEGOCIO) - TODOS LOS REGISTROS - CARTERA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 9px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .group-header {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }

        .highlight-yellow {
            background-color: #ffff00;
        }

        .highlight-red {
            background-color: #ffcccc;
        }

        .highlight-pink {
            background-color: #ffb6c1;
        }

        .summary {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .daily-summary {
            font-size: 9px;
        }

        .page-number {
            text-align: right;
            font-size: 9px;
            margin-top: 10px;
        }

        .amount {
            text-align: right;
        }

        .date {
            text-align: center;
        }

        .text-left {
            text-align: left;
            padding-left: 4px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LISTADO DE COBRO (CON NEGOCIO) - TODOS LOS REGISTROS - CARTERA</h1>
    </div>

    <div class="header-info">
        <div>
            <strong>FECHA DE GENERACION:</strong> {{ $generationDate ?? date('d F Y') }}
        </div>
        <div>
            <strong>COBRADOR:</strong> {{ $collector ?? '' }}
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Obs.</th>
                    <th rowspan="2">Ruta</th>
                    <th rowspan="2">Nombre</th>
                    <th rowspan="2">Monto</th>
                    <th colspan="2" class="group-header">Cobro Diario</th>
                    <th rowspan="2">Ult. Cuota</th>
                    <th colspan="3" class="group-header">Abono</th>
                    <th rowspan="2">Ultimo Pago</th>
                    <th rowspan="2">Inicia</th>
                    <th rowspan="2">Termina</th>
                    <th rowspan="2">Negocio</th>
                    <th rowspan="2">Direccion</th>
                    <th rowspan="2">Barrio</th>
                    <th rowspan="2">Telefono</th>
                </tr>
                <tr>
                    <th>Dias Cobro</th>
                    <th>Cuota</th>
                    <th>Ult. pic</th>
                    <th>Saldo</th>
                    <th>Mora</th>
                </tr>
            </thead>
            <tbody>
                @if (count($loans) > 0)
                    @foreach ($loans as $index => $loan)
                        @php
                            $hasDues = ($loan['dues'] ?? 0) > 0;
                            $hasLastPaymentWithDues = $hasDues && !empty($loan['lastPayment']);
                            $paymentDaysFormat = ($loan['paymentDays'] ?? '') . 'X' . ($loan['daysToPay'] ?? '');
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $loan['route']['name'] ?? '' }}</td>
                            <td style="text-align: left; padding-left: 4px;">
                                {{ strtolower($loan['client']['name'] ?? '') }}</td>
                            <td class="amount">{{ number_format($loan['amount'] ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $paymentDaysFormat }}</td>
                            <td class="amount {{ $hasDues ? 'highlight-yellow' : '' }}">
                                {{ number_format($loan['dailyPayment'] ?? 0, 0, ',', '.') }}</td>
                            <td class="amount">{{ number_format($loan['deposit'] ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $loan['pico'] ?? '' }}</td>
                            <td class="amount">{{ number_format($loan['balance'] ?? 0, 0, ',', '.') }}</td>
                            <td class="amount {{ $hasDues ? 'highlight-yellow' : '' }}">
                                {{ number_format($loan['dues'] ?? 0, 0, ',', '.') }}</td>
                            <td class="date {{ $hasLastPaymentWithDues ? 'highlight-pink' : '' }}">
                                @if (!empty($loan['lastPayment']))
                                    {{ \Carbon\Carbon::parse($loan['lastPayment'])->format('d-M') }}
                                @endif
                            </td>
                            <td class="date">
                                @if (!empty($loan['startDate']))
                                    {{ \Carbon\Carbon::parse($loan['startDate'])->format('d-M') }}
                                @endif
                            </td>
                            <td class="date">
                                @if (!empty($loan['finalDate']))
                                    {{ \Carbon\Carbon::parse($loan['finalDate'])->format('d-M') }}
                                @endif
                            </td>
                            <td style="text-align: left; padding-left: 4px;">
                                {{ strtolower($loan['client']['profession'] ?? '') }}</td>
                            <td style="text-align: left; padding-left: 4px;">
                                {{ strtolower($loan['client']['address'] ?? '') }}</td>
                            <td style="text-align: left; padding-left: 4px;">
                                {{ strtolower($loan['client']['neighborhood'] ?? '') }}</td>
                            <td>{{ $loan['client']['phone'] ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="17" style="text-align: center; padding: 20px;">
                            <strong>No hay préstamos registrados para mostrar en el listado de cobro.</strong>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="summary">
        <div class="daily-summary">
            <strong>LUN:</strong> {{ number_format($dailyTotals['lun'] ?? 0, 0, ',', '.') }}<br>
            <strong>MAR:</strong> {{ number_format($dailyTotals['mar'] ?? 0, 0, ',', '.') }}<br>
            <strong>MIE:</strong> {{ number_format($dailyTotals['mie'] ?? 0, 0, ',', '.') }}<br>
            <strong>JUE:</strong> {{ number_format($dailyTotals['jue'] ?? 0, 0, ',', '.') }}<br>
            <strong>VIE:</strong> {{ number_format($dailyTotals['vie'] ?? 0, 0, ',', '.') }}<br>
            <strong>SAB:</strong> {{ number_format($dailyTotals['sab'] ?? 0, 0, ',', '.') }}<br>
            <strong>DIARIO:</strong> {{ number_format($dailyTotals['diario'] ?? 0, 0, ',', '.') }}
        </div>
        <div class="page-number">
            PAGINA {{ $pageNumber ?? 1 }}
        </div>
    </div>
</body>

</html>
