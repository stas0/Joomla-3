<?php
    require_once __DIR__ . '/lib/mpdf/mpdf.php';
    $panelName = urldecode($_GET['panelName']);
    $colorName = urldecode($_GET['colorName']);
    $width = urldecode($_GET['width']);
    $height = urldecode($_GET['height']);
    $price = urldecode($_GET['price']);

    $mpdf = new mPDF();
    $mpdf->WriteHTML("
        <html>
            <head>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    
                    td {
                        border: 1px solid #000;
                        text-align: center;
                        padding: 5px;
                    }
                </style>
            </head>
            <body>
                <table>
                    <thead>
                        <tr>
                            <td>
                                Название панели
                            </td>
                            <td>
                                Название цвета
                            </td>
                            <td>
                                Ширина
                            </td>
                            <td>
                                Высота
                            </td>
                            <td>
                                Итого
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                $panelName
                            </td>
                            <td>
                                $colorName
                            </td>
                            <td>
                                $width
                            </td>
                            <td>
                                $height
                            </td>
                            <td>
                                $price
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
    ");
    $mpdf->Output();
?>