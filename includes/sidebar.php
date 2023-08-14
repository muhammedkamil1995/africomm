<div class="row">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Most Viewed Today</b></h3>
        </div>
        <div class="box-body">
            <ul id="trending">
                <?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
                <ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Become a Subscriber</b></h3>
        </div>
        <div class="box-body">
            <p>Get free updates on the latest products and discounts, straight to your inbox.</p>
            <form method="POST">
                <div class="input-group">
                    <input type="email" name="email" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" name="news_letter" class="btn btn-info btn-flat"><i
                                class="fa fa-envelope"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class='box box-solid'>
        <div class='box-header with-border'>
            <h3 class='box-title'><b>Follow us on Social Media</b></h3>
        </div>
        <div class='box-body'>
            <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
            <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
            <a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
            <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>

<script>
//this is getting the element of the button
const news_letter = document.getElementsByName('news_letter')[0];
// this is performing the click event
news_letter.addEventListener('click', e => {
    //Prevent the default behavior of the browser
    e.preventDefault();
    //this is getting the attribute of email 
    const email = document.querySelector('input[name="email"]');
    //this is use to alert the value of the variables

    const emailValue = email.value.trim(); // Remove leading and trailing whitespace

    // Regular expression pattern for email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // checking if email value is empty
    if (emailValue === '') {
        // show error message
        alert('Please enter an email address.');
        return
    }

    // validate email pattern
    if (!emailPattern.test(emailValue)) {
        alert('Please enter a valid email address.');
        return
    }

    const url = 'subscriber_list.php';
    const data = {
        email: emailValue
    };

    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                alert(data.message)
                return
            }
            alert(data.message)
            return
        })
        .catch(function(error) {
            console.error(error);
        });





});
</script>