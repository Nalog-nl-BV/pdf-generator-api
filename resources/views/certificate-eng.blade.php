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
    .validUntil_title_ua {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 20px;
        font-weight: regular;

        width: 255px;
        height: 30px;
        position: absolute;
        bottom: 187px;
        left: 130px;
    }
    .validUntil_title_en {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 20px;
        font-weight: regular;

        width: 255px;
        height: 30px;
        position: absolute;
        bottom: 187px;
        left: 135px;
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
    .employee_title_en {
        font-family: "montserrat-black", sans-serif;
        color: #188682;
        font-size: 20px;
        font-weight: regular;

        width: 477px;
        height: 30px;
        position: absolute;
        bottom: 187px;
        left: 380px;
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
    .number-title_en {
        font-family: "montserrat-black", sans-serif;
        color: #000000;
        font-size: 20px;
        font-weight: regular;

        width: 220px;
        height: 30px;
        position: absolute;
        bottom: 180px;
        right: 215px;
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
        @if( $data["language"] == "en")
            Discount<br>coupon
        @elseif($data["language"] == "ua")
            Купон на<br>знижку
        @elseif($data["language"] == "ru")
            Скидочный<br>купон
        @else()
            Скидочный<br>купон
        @endif
    </div>

    <div class="offer-title">
        @if( $data["language"] == "en")
            for the service:
        @elseif($data["language"] == "ua")
            на послугу
        @elseif($data["language"] == "ru")
            на услугу:
        @else()
            на услугу:
        @endif
    </div>
    <div class="offer">
        @if(isset($data["offer"]["link"]) && $data["offer"]["link"])
            <a class="link" href={{ $data["offer"]["link"] }}>
                {{ $data["offer"]["title"] }}
            </a>
        @else
            {{ $data["offer"]["title"] }}
        @endif
    </div>

    <div class="name-container">
        <div class="name-title">
            @if( $data["language"] == "en")
                Coupon recipient:
            @elseif($data["language"] == "ua")
                Одержувач купона:
            @elseif($data["language"] == "ru")
                Получатель купона:
            @else()
                Получатель купона:
            @endif
        </div>
        <div class="name">
            {{ $data["clientName"] }}
        </div>
    </div>

    <div class="discount-title">
        @if( $data["language"] == "en")
            The amount of the service discount:
        @elseif($data["language"] == "ua")
            Сумма знижки на послугу:
        @elseif($data["language"] == "ru")
            Сумма скидки на услугу:
        @else()
            Сумма скидки на услугу:
        @endif
    </div>
    <div class="discount-number">
        &#8364;{{ $data["discount"] }}
    </div>

    @if( $data["language"] == "en")
        <div class="validUntil_title_en">
            Valid until
        </div>
    @elseif($data["language"] == "ua")
        <div class="validUntil_title_ua">
            Дійсний до
        </div>
    @elseif($data["language"] == "ru")
        <div class="validUntil_title">
            Действителен до
        </div>
    @else()
        <div class="validUntil_title">
            Действителен до
        </div>
    @endif
    <div class="validUntil_value">
        {{ $data["date"] }}
    </div>

    @if( $data["language"] == "en")
        <div class="employee_title_en">
            The coupon was issued by an employee
        </div>
    @elseif($data["language"] == "ua")
        <div class="employee_title">
            Купон видав співробітник
        </div>
    @elseif($data["language"] == "ru")
        <div class="employee_title">
            Купон выдал сотрудник
        </div>
    @else()
        <div class="employee_title">
            Купон выдал сотрудник
        </div>
    @endif
    <div class="employee_value">
        {{ $data["employeeName"] }}
    </div>

    @if( $data["language"] == "en")
        <div class="number-title_en">
            Coupon number
        </div>
    @elseif($data["language"] == "ua")
        <div class="number-title">
            Номер купона
        </div>
    @elseif($data["language"] == "ru")
        <div class="number-title">
            Номер купона
        </div>
    @else()
        <div class="number-title">
            Номер купона
        </div>
    @endif
    <div class="number">
        {{ $data["number"] }}
    </div>

    <div class="footer">
        @if( $data["language"] == "en")
            To place your order at a discount, enter the coupon number in the appropriate field on the service page indicated in the coupon
        @elseif($data["language"] == "ua")
            Щоб оформити замовлення зі знижкою, введіть номер купона у відповідне поле на сторінці послуги, зазначеної в купоні
        @elseif($data["language"] == "ru")
            Чтобы оформить заказ со скидкой, введите номер купона в соответсвующее поле на странице услуги, указаной в купоне
        @else()
            Чтобы оформить заказ со скидкой, введите номер купона в соответсвующее поле на странице услуги, указаной в купоне
        @endif
    </div>
</body>
