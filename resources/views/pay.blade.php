@extends('layout')

@section('main')

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Thanh Toán</title>
        <!-- Font roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet" />
        <!-- Icon fontawesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <!-- Reset css & grid system -->
        <link rel="stylesheet" href="{{ asset('css/library.css') }}" />
        <!-- Owl Carousel css -->
        <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.theme.default.min.css') }}" />
        <!-- Layout -->
        <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
        <!-- Pay CSS -->
        <link rel="stylesheet" href="{{ asset('css/pay.css') }}" />
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Owl carousel Js -->
        <script src="{{ asset('owlCarousel/owl.carousel.min.js') }}"></script>

        <style>
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .message-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 50px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                z-index: 1000;
                display: none;
            }

            .success-message {
                text-align: center;
                font-size: 24px;
                color: green;
            }

            .error-message {
                text-align: center;
                font-size: 24px;
                color: red;
            }

            .close-button {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
                font-size: 24px;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <div class="grid wide">
                <div class="row">
                    <!-- Form thanh toán -->
                    <div class="col l-7 m-12 s-12">
                        <div class="pay-information">
                            <div class="pay__heading">Thông tin thanh toán</div>
                            <form class="form-horizontal caption" method="POST" id="payment-form"
                                action="{{ route('pay') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="ten" class="form-label">Tên người nhận *</label> <br />
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="ten" name="ten"
                                            placeholder="Tên người nhận" required autofocus />
                                        @if ($errors->has('ten'))
                                            <span class="text-danger text-left">{{ $errors->first('ten') }}</span><br />
                                        @endif
                                    </div>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label for="diachigiaohang" class="form-label">Địa chỉ *</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="diachigiaohang" class="form-control" name="diachigiaohang"
                                            placeholder="Địa chỉ" required />
                                        @if ($errors->has('diachigiaohang'))
                                            <span class="text-danger text-left">{{ $errors->first('diachigiaohang') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label for="sdt" class="form-label">Số điện thoại *</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="sdt" name="sdt"
                                            placeholder="Số điện thoại" required />
                                        @if ($errors->has('sdt'))
                                            <span class="text-danger text-left">{{ $errors->first('sdt') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <br />

                                <div class="form-group">
                                    <label for="ghichudonhang" class="form-label">Ghi chú đơn hàng</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="ghichudonhang" name="ghichudonhang"
                                            placeholder="Ghi chú đơn hàng" />
                                        @if ($errors->has('ghichudonhang'))
                                            <span class="text-danger text-left">{{ $errors->first('ghichudonhang') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label class="form-label">Phương thức thanh toán</label> <br>
                                    <br>
                                    <div class="col-sm-5">
                                        <div>
                                            <input type="radio" id="banking" name="payment_method" value="banking"
                                                checked />
                                            <label class="main__pay-text" for="banking">Chuyển khoản ngân hàng</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="cod" name="payment_method" value="cod" />
                                            <label class="main__pay-text" for="cod">Thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>
                                </div>

                                <br />
                            </form>
                        </div>
                    </div>

                    <!-- Đơn hàng bên phải -->
                    <div class="col l-5 m-12 s-12">
                        <div class="pay-order">
                            <div class="pay__heading">Đơn hàng của bạn</div>

                            @foreach ($cartItems as $item)
                                <div class="pay-info">
                                    <div class="main__pay-text special">{{ $item['name'] }}</div>
                                    <div class="main__pay-text">Số lượng: {{ $item['quantity'] }}</div>
                                    <div class="main__pay-price">
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ
                                    </div>
                                </div>
                            @endforeach

                            <div class="pay-info">
                                <div class="main__pay-text special">Giao hàng</div>
                                <div class="main__pay-text">Giao hàng miễn phí</div>
                            </div>

                            <div class="pay-info">
                                <p class=" main__pay-text special total-after-discount">Tổng tiền
                                    {{ number_format(session('total_after_discount')) }}đ
                                </p>
                            </div>
                            <div class="btn btn--default" id="order-btn">Đặt hàng</div>

                            <!-- Overlay -->
                            <div class="overlay" id="overlay"></div>

                            <!-- Message container -->
                            <div class="message-container" id="message-container">
                                <div class="close-button" id="close-button">×</div>
                                <div class="success-message" id="success-message" style="display: none;">
                                    Bạn đã đặt hàng thành công.
                                </div>
                                <div class="error-message" id="error-message" style="display: none;">
                                    Bạn cần nhập đầy đủ thông tin thanh toán.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </body>
@endsection