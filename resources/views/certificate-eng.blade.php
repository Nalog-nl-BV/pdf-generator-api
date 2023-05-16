<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap');

    body {
        font-family: 'Montserrat', sans-serif;
        text-align: center;
    }

    .container {
        background: url("./images/certificate_bg_eng.png") no-repeat left center;
        width: 1533px;
        height: 700px;
        margin: 0;
        position: relative;
    }

    .certificate-title {
        font-family: "montserrat-black", sans-serif;
        font-weight: bold;
        font-size: 70px;
        color: #136260;
        text-align: center;

        width: 800px;
        height: 170px;
        position: absolute;
        top: 160px;
        left: 45px;
    }

    .offer-title {
        font-family: "montserrat-black", sans-serif;
        font-weight: regular;
        font-size: 34px;
        color: #000000;
        text-align: center;

        width: 800px;
        height: 50px;
        position: absolute;
        bottom: 310px;
        left: 45px;
    }
    .offer {
        font-family: "montserrat", sans-serif;
        font-weight: bold;
        font-size: 40px;
        color: #000000;
        text-align: center;

        width: 800px;
        height: 170px;
        position: absolute;
        bottom: 150px;
        left: 45px;
    }
    .link {
        text-decoration: none;
        color: #000000;
    }

    .name-container {
        font-family: "montserrat-black", sans-serif;
        font-weight: regular;
        text-align: center;

        width: 650px;
        height: 130px;
        position: absolute;
        top: 70px;
        right: 32px;
    }
    .name-title {
        font-size: 20px;
    }
    .name {
        font-size: 45px;
        color: white;
    }

    .discount-title {
        font-family: "montserrat-black", sans-serif;
        text-align: center;
        font-size: 20px;
        font-weight: regular;

        width: 650px;
        height: 130px;
        position: absolute;
        top: 185px;
        right: 32px;
    }
    .discount-number {
        font-family: "montserrat", sans-serif;
        text-align: center;
        font-size: 145px;
        font-weight: bold;

        width: 650px;
        height: 180px;
        position: absolute;
        top: 235px;
        right: 32px;
    }

    .validUntil_title {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 20px;
        font-weight: regular;

        width: 255px;
        height: 30px;
        position: absolute;
        bottom: 187px;
        left: 95px;
    }
    .validUntil_value {
        font-family: "montserrat-black", sans-serif;
        color: black;
        font-size: 32px;
        font-weight: regular;

        width: 255px;
        height: 50px;
        position: absolute;
        bottom: 110px;
        left: 97px;
    }

    .employee_title {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 20px;
        font-weight: regular;

        width: 477px;
        height: 30px;
        position: absolute;
        bottom: 187px;
        left: 450px;
    }
    .employee_value {
        font-family: "montserrat-black", sans-serif;
        color: black;
        font-size: 32px;
        font-weight: regular;

        width: 477px;
        height: 50px;
        position: absolute;
        bottom: 110px;
        left: 450px;
    }

    .number-title {
        font-family: "montserrat-black", sans-serif;
        color: #000000;
        font-size: 20px;
        font-weight: regular;

        width: 220px;
        height: 30px;
        position: absolute;
        bottom: 180px;
        right: 210px;
    }
    .number {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 32px;
        font-weight: regular;

        width: 220px;
        height: 50px;
        position: absolute;
        bottom: 110px;
        right: 190px;
    }

    .footer {
        font-family: "montserrat-black", sans-serif;
        font-weight: regular;
        font-size: 20px;
        opacity: 0.7;

        width: 91%;
        position: absolute;
        bottom: 50px;
        left: 60px;
        color: #000000;
        text-align: center;
    }

</style>
<body class="container">
    <div class="certificate-title">
        Скидочный<br>купон
    </div>

    <div class="offer-title">
        на улугу:
    </div>
    <div class="offer">
        <a class="link" href={{ $data["offer"]["link"] }}>
            {{ $data["offer"]["title"] }}
        </a>
    </div>

    <div class="name-container">
        <div class="name-title">
            Получатель купона:
        </div>
        <div class="name">
            {{ $data["clientName"] }}
        </div>
    </div>

    <div class="discount-title">
        Сумма скидки на услугу:
    </div>
    <div class="discount-number">
        &euro;{{ $data["discount"] }}
    </div>

    <div class="validUntil_title">
        Действителен до
    </div>
    <div class="validUntil_value">
        {{ $data["date"] }}
    </div>

    <div class="employee_title">
        Купон выдал сотрудник
    </div>
    <div class="employee_value">
        {{ $data["employeeName"] }}
    </div>

    <div class="number-title">
        Номер купона
    </div>
    <div class="number">
        {{ $data["number"] }}
    </div>

    <div class="footer">
        Чтобы оформить заказ со скидкой, введите номер купона в соответсвующее поле на странице услуги, указаной в купоне
    {{--    Certificate is valid until 05.05.2023. After this date, the certificate expires and is no longer accepted.--}}
    </div>
</body>
