<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Laporan Barang | PDF</title>

    <style>
        .title {
            display: grid;
            place-items: center;
        }

        .invoice-box {
            max-width: 100%;
            margin: auto;
            /* padding: 30px; */
            /* border: 1px solid #eee; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
            display: grid;
            text-align: center;

        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: center;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
            text-align: center;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body onload="window.print();">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('foto_gudang/afkaalogo.png') }}"
                                    style="width: 100%; max-width: 300px" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Jalan Kaliurang Km. 12,5, Harjobinangun, Pakem,<br />
                                Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                @php
                    $dataA = []
                @endphp
                <td style="text-align: center; font-weight: Bold;">Area: @foreach ($barang as $a)
                    @if ($a->area != null)
                        @php
                            $dataA[] = $a->area->area
                        @endphp
                    @endif
                    @endforeach
                    @php
                        $uniqueA = collect($dataA)->unique()->implode(', ');
                    @endphp
                    {{ $uniqueA }}
                </td>
            </tr>
            <tr>

                @php
                    $dataB = []
                @endphp
                <td style="text-align: center; font-weight: Bold;">Lokasi: @foreach ($barang as $b)
                    @if ($b->lokasi != null)
                        @php
                            $dataB[] = $b->lokasi->lokasi
                        @endphp
                    @endif
                    @endforeach
                    @php
                        $uniqueB = collect($dataB)->unique()->implode(', ');
                    @endphp
                    {{ $uniqueB }}
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>No</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Stock</td>
                <td>Kondisi Barang</td>
                <td>Tanggal Masuk</td>
            </tr>

            @foreach ($barang as $item)
                <tr class="details">
                    <td scope="row">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $loop->iteration }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $item->code }}
                    </td>
                    <td>
                        {{ $item->nama }}
                    </td>
                    <td>
                        {{ $item->stock }}
                    </td>
                    <td>
                        {{ $item->status->status ?? '-' }}
                    </td>
                    <td>
                        {{ $item->tgl_masuk }}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</body>

</html>
