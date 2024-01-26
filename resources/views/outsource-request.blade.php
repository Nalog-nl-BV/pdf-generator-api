<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap');

    .container {
        width: 800px;
        height: 1050px;
        margin: 0 auto;

        padding: 10px 40px;
        position: relative;
    }

    .logo {
        margin: 20px;
    }

    .confidential {
        margin-top: 30px;
    }

    .title {
        margin-top: 20px;
        text-align: center;
    }

    .title p {
        margin: 5px 0;
    }

    .date {
        position: absolute;
        right: 40px;
        top: 245px
    }

    .date p {
        margin: 5px 0;
    }

    .main-content {
        margin-top: 30px;
    }

    .signature_name {
        margin-top: 20px;
        margin-bottom: 10px;
        height: 100px;
    }

    .sign_stamp {
        /*width: 100%;*/
        /*height: 125px;*/
        /*position: relative;*/
    }

    .signature {
        /*position: absolute;*/
        /*right: 100px;*/
    }

    .stamp {
        /*position: absolute;*/
        /*left: 30px;*/
    }

    .contact_left p,
    .contact_right p {
        margin: 4px 0;
    }

    .contact_left {
        position: absolute;
        left: 60px;
        bottom: 80px;
    }

    .contact_right {
        position: absolute;
        right: 130px;
        bottom: 80px;
    }

    .Referentienunumen {
        position: absolute;
        bottom: 50px;
        left: 260px;
    }

    .pagina {
        position: absolute;
        bottom: 50px;
        right: 40px;
    }

    .order {
        border-collapse: collapse;
        font-size: 16px;
        width: 100%;
    }
    .order-table {
        border: 1px solid;
    }
</style>
<body class="container">
<div class="logo">
    <img src="https://internal.nalog.nl/wp-content/uploads/2022/12/Skype_Picture_2022_12_24T16_17_37_254Z.png"
         alt="logo" width="200">
</div>

<h4 class="confidential">
    VERTROUWELIJK
</h4>
<div class="title">
    <p>ПИСЬМО-ЗАЯВКА</p>
    <p>НА ВЫПОЛНЕНИЕ УСЛУГ № <b>{{ $data['number'] }}</b></p>
    <p style="padding-top:10px;">от <b>{{ $data['date'] }}</b></p>
</div>

<div class="main-content">
    <p>
        Данным письмом компания Nalog.NL
        (Заказчик) подтверждает передачу Евромета ТД (Исполнителю) архива первичных документов в электронном виде
        на удалённом рабочем столе (размещение согласно утверждённому маршруту движения документов).
    </p>

    <p>
        Предоставление услуг проводится на условиях и в сроки, указанные в Договоре.
    </p>

    <p>
        Архив включат документы следующих клиентов:
    </p>

    <table class="order">
        <thead>
        <tr class='order-table'>
            @foreach (array_keys($data['orders'][0]) as $row)
                <th class="order-table" style="background:#D3D3D3">{{ $row }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($data['orders'] as $row)
            <tr class='order-table'>
                @foreach ($row as $value)
                    <td class='order-table'>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

    <p> Общий комментарий к заказу: {{ $data['comment'] }} </p>
</div>

<div class="sign_stamp">
    <div class="signature">
        <p>Отправил бухгалтер: <span style="text-decoration: underline;">{{ $data['accountant_name'] }}</span></p>
    </div>
    <div class="stamp">
        <img src="https://internal.nalog.nl/wp-content/uploads/2023/05/print.png" alt="stamp" width="180">
    </div>
</div>

<div class="contact_left">
    <div>
        <p>Nalog.nl B.V.</p>
        <p>KVK: 66449898</p>
        <p>Beconnummer: 596358</p>
        <p>BTW-nummer: NL856558692B01</p>
    </div>
</div>

<div class="contact_right">
    <div>
        <p>Dukatenburg 82 3437AE Nieuwegein</p>
        <p>+31 (0) 85 5400 200</p>
        <p>+31 (0) 65 0128 355</p>
        <p>info@nalog.nl</p>
    </div>
</div>

<div class="Referentienunumen">
    Referentienunumen: {{ $data['hash'] }}
</div>
<div class="pagina">
    Pagina 1/1
</div>
</body>
