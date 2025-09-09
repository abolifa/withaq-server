@php
    use Carbon\Carbon;
@endphp

    <!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $record->issue_number }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        h1 {
            line-height: 1.5;
            font-size: 17pt;
            font-weight: bold;
        }

        p {
            margin: 0;
            padding: 0;
            line-height: 1.5;
            font-size: 14pt;
        }
    </style>
</head>
<body>

<table style="width: 100%;">
    <tr>
        <td style="text-align: right; vertical-align: center;">
            <p>التاريخ: {{ Carbon::parse($record->issue_date)->format('d/m/Y') }}</p>
        </td>
        <td style="text-align: left; vertical-align: center;">
            <p>الإشاري: {{ $record->issue_number }}</p>
        </td>
    </tr>
</table>
<br/>
<br/>

<table style="width: 100%;">
    <tr>
        <td style="text-align: right; vertical-align: center;">
            <h1>السادة / {{ $record->to }}</h1>
            <br/>
            <h1>الموضوع / {{ $record->subject }}</h1>
        </td>
        <td style="text-align: left; vertical-align: center; width: 120px;">
            @if($record->qr_code)
                <barcode code="{{ $record->qr_code }}" type="QR" size="1.2" error="M"></barcode>
            @endif
        </td>
    </tr>
</table>
<p>{{ $record->template?->greetings }}</p>
<br/>
<div style="margin: 0 10px; text-align: justify;">{!! $record->body !!}</div>
<br/>
<p style="text-align: center; font-weight: bold">{{ $record->template?->closing }}</p>
<br/>
<div style="width: 100%; page-break-inside: avoid; direction: ltr;">
    <div style="width: 300px; text-align: center;">

        @if ($record->template?->show_position)
            <p style="margin:0; padding:5px; font-weight: bold;">
                {{ $record->template?->position }}
            </p>
        @endif

        @if ($record->template?->show_commissioner)
            <p style="margin:0; padding:5px; font-weight: bold;">
                {{ $record->template?->commissioner }}
            </p>
        @endif

        <table style="width: 100%; page-break-inside: avoid;">
            <tr>
                <td style="text-align: center; vertical-align: top;">
                    @if ($record->template?->show_stamp && $record->template?->stamp && Storage::disk('public')->exists($record->template->stamp))
                        <img src="{{ Storage::disk('public')->path($record->template->stamp) }}" alt="الختم"
                             height="200">
                    @endif
                </td>
                <td style="text-align: center; vertical-align: top;">
                    @if ($record->template?->show_signature && $record->template?->signature && Storage::disk('public')->exists($record->template->signature))
                        <img src="{{ Storage::disk('public')->path($record->template->signature) }}" alt="التوقيع"
                             height="200">
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
