<section class="bg-1 widewrapper text-center">

    <h1><span class="not_timer">Oh, hi there</span></h1>
    <p class="lead">We're still working on this area</p> 
    <button type="button" onclick="javascript:location.href='<?php echo $fullUrl; ?>'" class="btn btn-minetract btn-lg">Home</button>
    <button type="button" onclick="goBack()" class="btn btn-minetract btn-lg">Back</button>

</section>

<div class="container">
    <div class="row">
        <h1 class="coming_soon">the <?php echo basename($_SERVER['PHP_SELF'],'.php');  ?> page is coming soon</h1>
        <h3 class="coming_soon">
            Thanks for taking the time to check out this area.
            <br>
            We'll keep you updated on the new features we are adding
            <br>
            throughout the site through our newsfeed on our homepage
            <br>
            and through our monthly Newsletters.

        </h3>
    </div>
</div>
<script>
function goBack() {
    window.history.go(-1)
}
</script>