<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap');

    .container {
        width: 752px;
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

    .address {
        margin-top: 20px;
    }

    .address p {
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

    .signature_sign {
        position: absolute;
        left: 70px;
        bottom: 170px;
    }

    .stamp {
        position: absolute;
        right: 200px;
        bottom: 180px;
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

    .footer {
        position: absolute;
        bottom: 50px;
        width: 100%;
        text-align: center;
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
<div class="address">
    <p>Belastingdienst</p>
    <p>Antwoordummer 21020</p>
    <p>6400XC Heerlen</p>
</div>

<div class="date">
    <p style="padding-right: 20px;">
        Datum
    </p>
    <p>
        {{$data["date"]}}
    </p>
</div>

<div class="main-content">
    <p>Onze referentle: 543/2022</p>

    <p>Tem name: <span>{{ $data["name"] }} </span>BSN: <span>{{$data["bsn"]}} </span>GD: <span>{{$data["birthday"]}}</span></p>

    <p style="font-weight: bold;">Betreft: buitealandse rekenlugnummer doorgeven</p>

    <p>Geachte heer/mevrouw,</p>

    <p>Hierbij aburen wij de gegevena van bankrekenlngnummer voor alle belastingen van onze klant {{$data["name"]}}.</p>

    <p>
        Naam van bank: {{$data["bank_name"]}} <br>
        Rekeninghouder: {{$data["full_name"]}} <br>
        IBAN: {{$data["iban"]}} <br>
        Adres van bank: {{$data["bank_address"]}}
    </p>

    <p>Bijlagen:</p>

    <p style="padding-left: 30px;">
        1. kopie van paspot <br>
        2. kopie van bankschrift
    </p>

    <p>
        Hopalijk habben wij uw voldoende geinformeerd. Indien u meer informatie wenst, kunt i met ons contact opnemen op
        telefoonnummer 085-5400200 of via email: info@nalog.nl van maandag t/m vrijdag van 10-00 bot 18-00.
    </p>

    <p>
        Met vriendelijke groet, <br>
        Administratief medewerker
    </p>
</div>

<div class="signature_name">
    Julia Jurik
</div>
<div class="signature_sign">
    <img src="https://internal.nalog.nl/wp-content/uploads/2023/05/photo_2023-05-16_15-59-06.jpg" alt="sign" width="70">
</div>
<div class="stamp">
    <img src="https://internal.nalog.nl/wp-content/uploads/2023/05/photo_2023-05-16_15-14-19.jpg" alt="stamp" width="180">
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

<div class="footer">
    Referentienunumen: 0cbdfkmk03j358gnlfgn3ng0n23
</div>
</body>
