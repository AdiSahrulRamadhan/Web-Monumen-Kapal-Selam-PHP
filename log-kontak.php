<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Review & Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        body {
            overflow-x: hidden;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #0A4773;
            color: white;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Center the navigation menu */
        }

        nav ul li {
            margin-right: 10px;
            font-size: 20px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 20px; /* Add padding for better click area */
            display: block; /* Ensure the anchor takes up the full space of the list item */
            text-align: center; /* Center text inside the anchor */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background and text color */
        }

        nav ul li a:hover {
            text-decoration: none;
            background-color: black;
            color: #fff; /* Optional: change text color on hover */
            border-radius: 5px; /* Optional: rounded corners */
        }
        
        .content {
            margin: 0;
            padding: 20px; 
            height: 45vh; 
            background-image: url('Gambar/Picture18.png'); 
            background-size: cover;
            background-position: center;
            color: white;
            text-align: left;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }
        
        .content-box {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-left: 90px; 
            margin-bottom: 350px;
            text-align: justify;
            color: white; 
        }
        
        .content h1 {
            font-size: 40px;
            font-family: Patua One;
            font-style: italic;
        }
        
        .kontak {
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 30px 200px;
            background-color: #ebf6fe;
        }
        
        .kontak-detail {
            flex-grow: 1;
            text-align: justify;
        }
        
        .kontak-detail  {
            padding-bottom: 20px;
        }
        
        .kontak-detail strong {
            display: inline-block;
            width: 100px;
        }
        
        .kontak-detail p {
            margin: 0;
            padding-bottom: 30px;
            width: 400px;
        }
        
        .maps {
            width: 50%;
        }
        
        .containerr {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
            padding: 20px;
        }
        
        .form-container,
        .review-container {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
        }
        
        .form-container {
            box-sizing: border-box;
        }
        
        .review-container {
            overflow-y: auto;
            max-height: 400px;
        }
        
        h2 {
            margin-top: 0;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            margin-bottom: 10px;
        }
        
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        
        .review {
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: left;
        }
        
        .rating input {
            display: none;
        }
        
        .rating label {
            display: inline-block;
            cursor: pointer;
        }
        
        .rating label:before {
            content: "\2605";
            font-size: 30px;
        }
        
        .rating input:checked ~ label:before {
            color: orange;
        }
        
        .dropdown-menu {
            position: absolute;
            width: 70px;
            list-style: none;
            background-color: #fff;
            border: 2px solid black;
            padding: 0;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            left: -40px;
        }
        .dropdown-menu a {
            border-radius: 10px;
            width: 100%;
            color: #333; 
            padding: 8px 15px;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .dropdown-menu a:hover {
            background-color: #0A4773;
        }
        
        .dropdown-menu li a {
            font-size: 15px;
        }
        
        footer {
            background-color: #2D2C2C;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        
        .footer-left, .footer-right {
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <img src="Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 60px; height: 60px; margin-left: 50px; margin-right: -370px;">
        <span style="font-size: 25px;"><a href="log-main.php" style="color: white; text-decoration: none; font-family: Segoe Print;">Monumen Kapal Selam</a></span>
        <ul>
            <li><a href="log-main.php">Beranda</a></li>
            <li><a href="log-fasilitas.php">Fasilitas</a></li>
            <li><a href="log-gallery.php">Gallery</a></li>
            <li><a href="log-sejarah.php">Sejarah</a></li>
            <li><a href="log-kontak.php">Kontak</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li><a href="log-login.php" data-toggle="">Login</a></li>
                <li><a href="log-sign-up.php" data-toggle="">Daftar</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="content"> 
    <div class="content-box">
        <h1 style="text-shadow: -1px -1px 0 black,  
        1px -1px 0 black,
       -1px  1px 0 black,
        1px  1px 0 black;">Kontak</h1>
        <hr style="width: 100%; margin: 10px auto; border: 3px solid white;">
    </div>
</div>

<h1 style="text-align: center; padding-top: 20px;">Kontak Kami</h1>
<hr style="width: 50%; margin: 10px auto; border: 3px solid #2697FF;">
<div class="kontak">
    <div class="kontak-detail">
        <h2>Kontak Detail</h2>
        <strong><i class="fas fa-map-marker-alt"></i> Alamat</strong>
        <p>Jl. Pemuda No.39, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur 60271</p>
        <strong><i class="fas fa-phone"></i> Telp</strong>
        <p>(031) 5490410</p>
        <strong><i class="fas fa-envelope"></i> Email</strong>
        <p>monumenkapalselamsby@gmail.com</p>
    </div>
    <div class="maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.782770860351!2d112.74770537476043!3d-7.265544692741319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9628df520e5%3A0x577443720136fb0b!2sMonumen%20Kapal%20Selam%20Surabaya!5e0!3m2!1sid!2sid!4v1715253994728!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="container">
        <h1 class="mt-5 mb-5">Review & Rating Monumen Kapal Selam</h1>
    	<div class="card">
            <div class="card-header">Kolom Ulasan Pengunjung</div>
    		<div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
                        <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Beri Ulasan Anda Disini</h3>
    					<button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kirim Ulasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <div class="form-group">
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                    </div>
                    <div class="form-group">
                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-left">
            Copyright © 2024 Monumen Kapal Selam Surabaya
        </div>
        <div class="footer-right">
            Powered by Monumen Kapal Selam Surabaya
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var rating_data = 0;
        
        $('#add_review').click(function(){
            
            $('#review_modal').modal('show');
            
        });
        
        $(document).on('mouseenter', '.submit_star', function(){
            
            var rating = $(this).data('rating');
            
            reset_background();
            
            for(var count = 1; count <= rating; count++)
            {
                
                $('#submit_star_'+count).addClass('text-warning');
                
            }
            
        });
        
        function reset_background()
        {
            for(var count = 1; count <= 5; count++)
            {
                
                $('#submit_star_'+count).addClass('star-light');
                
                $('#submit_star_'+count).removeClass('text-warning');
    
        }
    }
    
    $(document).on('mouseleave', '.submit_star', function(){
    
        reset_background();
    
        for(var count = 1; count <= rating_data; count++)
        {
    
            $('#submit_star_'+count).removeClass('star-light');
    
            $('#submit_star_'+count).addClass('text-warning');
        }
    
    });
    
    $(document).on('click', '.submit_star', function(){
    
        rating_data = $(this).data('rating');
    
    });
    
    $('#save_review').click(function(){
    
        var user_name = $('#user_name').val();
    
        var user_review = $('#user_review').val();
    
        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"log-submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');
    
                    load_rating_data();
    
                    alert(data);
                }
            })
        }
    
    });
    load_rating_data();
    
        function load_rating_data()
        {
            $.ajax({
                url:"log-submit_rating.php",
                method:"POST",
                data:{action:'load_data'},
                dataType:"JSON",
                success:function(data)
                {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);
    
                    var count_star = 0;
    
                    $('.main_star').each(function(){
                        count_star++;
                        if(Math.ceil(data.average_rating) >= count_star)
                        {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });
    
                    $('#total_five_star_review').text(data.five_star_review);
    
                    $('#total_four_star_review').text(data.four_star_review);
    
                    $('#total_three_star_review').text(data.three_star_review);
    
                    $('#total_two_star_review').text(data.two_star_review);
    
                    $('#total_one_star_review').text(data.one_star_review);
    
                    $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
    
                    $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
    
                    $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
    
                    $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
    
                    $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
    
                    if(data.review_data.length > 0)
                    {
                        var html = '';
    
                        for(var count = 0; count < data.review_data.length; count++)
                        {
                            html += '<div class="row mb-3">';
    
                            html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';
    
                            html += '<div class="col-sm-11">';
    
                            html += '<div class="card">';
    
                            html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';
    
                            html += '<div class="card-body">';
    
                            for(var star = 1; star <= 5; star++)
                            {
                                var class_name = '';
    
                                if(data.review_data[count].rating >= star)
                                {
                                    class_name = 'text-warning';
                                }
                                else
                                {
                                    class_name = 'star-light';
                                }
    
                                html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                            }
    
                            html += '<br />';
    
                            html += data.review_data[count].user_review;
    
                            html += '</div>';
    
                            html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
    
                            html += '</div>';
    
                            html += '</div>';
    
                            html += '</div>';
                        }
    
                        $('#review_content').html(html);
                    }
                }
            })
        }
    </script>
</body>
</html>
