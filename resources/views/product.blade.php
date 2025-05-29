@extends('layout')

@section('main')
<!DOCTYPE html>
<html lang="en">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiêt sản phẩm</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="css/library.css">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="{{asset('owlCarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('owlCarousel/assets/owl.theme.default.min.css')}}">
    <!-- Layout -->
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="{{ asset('owlCarousel/owl.carousel.min.js') }}"></script>
    <style>
        .productInfo__addToCart {
            display: flex;
            align-items: center;
        }

        /* Đặt khoảng cách giữa các phần tử con */
        .productInfo__addToCart button {
            margin-right: 5px;
            /* Khoảng cách 5px giữa các nút */
        }

        .likeButton {
            height: 5px;
            /* Thêm các thuộc tính CSS để căn chỉnh icon vào giữa nút */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .likeButton i {
            /* Chỉnh kích thước, màu sắc hoặc bất kỳ thuộc tính CSS nào khác cho icon tại đây */
            font-size: 24px;
            color: #fff;
            /* Màu đỏ, bạn có thể thay đổi theo ý muốn */
        }

        /* Add the following CSS styles for the "Thích" button */
        .likeButton {
            height: 20px;
            /* Remove the height property to allow the button to adjust its height based on the content */
            padding: 5px 10px;
            /* Add padding to give some space around the icon and text */
            background-color: #ff0000;
            /* Change the background color to red */
            border-radius: 5px;
            /* Add border radius to give a rounded look */
            cursor: pointer;
            /* Change the cursor to a pointer to indicate clickability */
        }

        .likeButton i {
            font-size: 24px;
            /* Keep the font-size as 24px */
            color: #fff;
            /* Keep the color as white */
        }
    </style>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
</head>

<body>
    <div class="main">
        <div class="grid wide">
            <div class="productInfo">
                <div class="row">
                    @if (isset($sanpham))
                    <div class="col l-5 m-12 s-12">
                        <div class="owl-carousel owl-theme" id="sync1">
                            <div class="product__avt">
                                <img src="{{ asset('img/product/' . $sanpham->hinh) }}" alt="" class="product__image">
                            </div>
                        </div>
                    </div>
                    <div class="col l-7 m-12s s-12 pl">
                        <h3 class="productInfo__name">
                            {{ $sanpham->ten }}
                        </h3>
                        @php
                            $giaMoi = $sanpham->gia - $sanpham->sale;
                        @endphp
                        <div class="productInfo__price" style="color:red">
                            {{ $giaMoi }} <span class="priceInfo__unit"></span>
                        </div>
                        <div class="productInfo__description">
                            <span>{{ $sanpham->ten }} <br> <br> </span> Mô tả là : {{ $sanpham->mota }}
                        </div>

                        <div class="productInfo__addToCart">
                            <!-- Nút Thích -->
                            @php
                               $userLiked = \DB::table('product_likes')
                                ->where('user_id', auth()->id())
                                ->where('sanpham_id', $sanpham->sanpham_id)
                                ->exists();
                                @endphp
                                <button id="likeButton" class="btn btn--default"
                                    data-product-id="{{ $sanpham->sanpham_id }}"
                                    style="height: 60px;"
                                    {{ $userLiked ? 'disabled' : '' }}>
                                    <i class="icon-heart"></i>
                                    <span id="likeCount" style="font-size: 40px;">{{ $sanpham->like }}</span>
                                </button>
                            <!-- Nút Thêm vào giỏ hàng -->




                                        </div>

                                        <div class="productIndfo__policy ">
                                            <div class="policy bg-1 ">
                                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                                <div class="productIndfo__policy-info ">
                                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                                </div>
                                            </div>
                                            <div class="policy bg-2 ">
                                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                                <div class="productIndfo__policy-info ">
                                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                                </div>
                                            </div>
                                            <div class="policy bg-1 ">
                                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                                <div class="productIndfo__policy-info ">
                                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                                </div>
                                            </div>
                                            <div class="policy bg-2 ">
                                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                                <div class="productIndfo__policy-info ">
                                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="productIndfo__category ">
                                            <p class="productIndfo__category-text"> Danh mục : <a href="# "
                                                    class="productIndfo__category-link ">{{ $sanpham->danhmucsp_id }}</a></p>

                                            <p class="productIndfo__category-text"> Số lượng đã bán :
                                                <span>{{ $sanpham->soluongdaban }}</span>
                                            </p>
                                            <p class="productIndfo__category-text"> Số lượng trong kho :
                                                <span>{{ $sanpham->soluongtrongkho }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            @else
                <p>Sản phẩm không tồn tại.</p>
                @endif
            </div>



                <!-- BINH LUAN -->



            </div>
        </div>

        @yield('content')
        <!-- Messenger Plugin chat Code -->
        <div id="fb-root"></div>

        <!-- Your Plugin chat code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            function minusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var currentValue = parseInt(inputQty.value);
                if (currentValue > 1) {
                    inputQty.value = currentValue - 1;
                    updateCartQuantity(currentValue - 1);
                }
            }

            function plusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var currentValue = parseInt(inputQty.value);
                var maxValue = parseInt(inputQty.getAttribute('max'));
                if (currentValue < maxValue) {
                    inputQty.value = currentValue + 1;
                    updateCartQuantity(currentValue + 1);
                }
            }
        </script>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "105913298384666");
            chatbox.setAttribute("attribution", "biz_inbox");
            window.fbAsyncInit = function () {
                FB.init({
                    xfbml: true,
                    version: 'v10.0'
                });
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script>
            $(document).ready(function () {
                var sync1 = $("#sync1 ");
                var sync2 = $("#sync2 ");
                var slidesPerPage = 4;
                var syncedSecondary = true;
                sync1.owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 20,
                    nav: true,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true
                })
                sync2
                    .on('initialized.owl.carousel', function () {
                        sync2.find(".owl-item ").eq(0).addClass("current ");
                    })
                    .owlCarousel({
                        items: 4,
                        dots: false,
                        nav: false,
                        margin: 30,
                        smartSpeed: 200,
                        slideSpeed: 500,
                        slideBy: 4,
                        responsiveRefreshRate: 100
                    }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2
                        .find(".owl-item ")
                        .removeClass("current ")
                        .eq(current)
                        .addClass("current ");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click ", ".owl-item ", function (e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });
            });

            $('.owl-carousel.hight').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 6
                    }
                }
            })

            function plusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var value = parseInt(inputQty.value, 10);
                if (value < 10) {
                    value++;
                    inputQty.value = value;
                }
                toggleMinusButton(value);
            }

            function minusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var value = parseInt(inputQty.value, 10);
                if (value > 1) {
                    value--;
                    inputQty.value = value;
                }
                toggleMinusButton(value);
            }

            function toggleMinusButton(value) {
                var minusButton = document.querySelector('.minus');
                if (value <= 1) {
                    minusButton.style.visibility = 'none';
                } else {
                    minusButton.style.visibility = 'inline-block';
                }
            }

            // Kích hoạt khi tải trang
            document.addEventListener('DOMContentLoaded', function () {
                toggleMinusButton(document.querySelector('.input-qty').value);
            });

            $(document).ready(function () {
                $('#likeButton').click(function () {
                    var productId = $(this).data('product-id');
                    $.ajax({
                        url: '/sanpham/' + productId + '/like',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            // Cập nhật số lượt thích
                            $('#likeCount').text(response.likes);
                            alert('Cảm ơn bạn đã thích sản phẩm!');
                            $('#likeButton').prop('disabled', true); // Disable nút sau khi like
                        },
                        error: function (xhr) {
                            if (xhr.status === 409) {
                                alert('Bạn đã thích sản phẩm này rồi!');
                                $('#likeButton').prop('disabled', true); // Disable nút nếu đã like
                            } else {
                                alert('Có lỗi xảy ra, vui lòng thử lại.');
                            }
                        }
                    });
                });
            });

           








        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Script common -->
        <script src="{{ asset('js/commonscript.js') }} "></script>
</body>

</html>
@endsection