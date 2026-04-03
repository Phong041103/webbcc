@extends('layout')

@section('content')

<style>
/* Reset & Container */
.contact-section {
    padding: 50px 0;
    background-color: #fcfcfc;
}

/* Thẻ bọc nội dung (Card) */
.contact-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0,0,0,0.05);
    padding: 40px;
    margin-bottom: 30px;
}

/* Tiêu đề */
.contact-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
    text-transform: uppercase;
    position: relative;
    padding-bottom: 10px;
}

.contact-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    background: #ff5722;
}

/* Cột thông tin liên hệ */
.info-list {
    list-style: none;
    padding: 0;
    margin: 0 0 30px 0;
}

.info-list li {
    font-size: 16px;
    color: #555;
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
}

.info-list li i {
    color: #ff5722;
    font-size: 20px;
    margin-right: 15px;
    margin-top: 3px;
}

/* Bản đồ Google Map */
.map-container iframe {
    width: 100%;
    height: 250px;
    border-radius: 10px;
    border: none;
}

/* Form Styling */
.form-group {
    margin-bottom: 20px;
}

.custom-input {
    width: 100%;
    padding: 15px 20px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    background: #fdfdfd;
    transition: all 0.3s ease;
}

.custom-input:focus {
    outline: none;
    border-color: #ff5722;
    box-shadow: 0 0 8px rgba(255, 87, 34, 0.1);
    background: #fff;
}

textarea.custom-input {
    min-height: 150px;
    resize: vertical;
}

/* Nút Submit đồng bộ với nút Giỏ hàng */
.btn-submit-contact {
    background: #ff5722;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    padding: 15px 40px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
}

.btn-submit-contact:hover {
    background: #e64a19;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
}
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('trang-chu') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Trang chủ</a></li>
            <li class="active">Liên hệ</li>
        </ol>
    </div>
</div>
<div class="contact-section">
    <div class="container">
        <div class="contact-card">
            <div class="row">
                
                <div class="col-md-5 mb-4">
                    <h3 class="contact-title">Thông tin liên hệ</h3>
                    
                    <ul class="info-list">
                        <li>
                            <i class="glyphicon glyphicon-map-marker"></i>
                            <span>180 cao lỗ, phường 4, quận 8, TP. Hồ Chí Minh</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-earphone"></i>
                            <span>0123456789</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-envelope"></i>
                            <span>info@example.com</span>
                        </li>
                    </ul>

                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.123456789!2d106.7017555!3d10.7760195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f46755561bb%3A0x8bd121c82eb28dc3!2sBitexco%20Financial%20Tower!5e0!3m2!1svi!2s!4v1620000000000!5m2!1svi!2s" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <div class="col-md-7">
                    <h3 class="contact-title">Gửi tin nhắn cho chúng tôi</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="#" method="POST">
                        @csrf <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="custom-input" placeholder="Họ và tên của bạn *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" class="custom-input" placeholder="Email của bạn *" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" class="custom-input" placeholder="Chủ đề (Tùy chọn)">
                        </div>

                        <div class="form-group">
                            <textarea name="message" class="custom-input" placeholder="Nhập nội dung tin nhắn của bạn tại đây... *" required></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn-submit-contact">
                                <i class="glyphicon glyphicon-send"></i> Gửi tin nhắn
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection