<?php
  // Get your Tumblr API key here: http://www.tumblr.com/docs/en/api/v2
  $api_key = "";
  $tag = (urldecode($_GET['tag']) != null ? urldecode($_GET['tag']) : 'news');
  $stories = json_decode(file_get_contents("http://api.tumblr.com/v2/tagged?tag=" . $tag . "&api_key=" . $api_key))->response;
  $cats = json_decode(file_get_contents("http://api.tumblr.com/v2/tagged?tag=cats&api_key=" . $api_key))->response;
?>
<!DOCTYPE html>
  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>The Tumblr Times</title>
    <meta name="description" content="A fake newspaper made with real Tumblr content">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
  </head>
  <body>
    <div class="whole-container">
      <div class="page-container">
        <!--[if lt IE 7]>
          <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <header id="main-header">
          <div class="box-tagline">"All the Reblogs<br />Fit to Print"</div>
          <img src="img/tumblr_times_header.png" height="141" width="971" alt="The Tumblr Times">
        </header>
        <div id="main-subheader">New York, <?php echo date("l, F n, Y"); ?></div>
        <article class="story three_col">
        <?php foreach($stories as $story): ?>
          <?php if ($story->type != "link"): ?>
              <?php if ($story->type == "photo"): ?>
                <img src="<?php echo $story->photos[0]->alt_sizes[2]->url; ?>" alt="" />
                <?php echo $story->caption; ?>
              <?php elseif ($story->type == "quote"): ?>
                <em>&quot;<?php echo $story->text; ?>&quot;</em>
                - <?php echo $story->source; ?>
              <?php elseif ($story->type == "text"): ?>
                <h2><?php echo $story->title; ?></h2>
                <?php echo $story->body; ?>
              <?php endif; ?>
              <hr />
          <?php endif; ?>
        <?php endforeach;?>
        </article>
      </div>
      <div class="page-container">
        <div id="main-subheader">The Tumblr Times <b>Cats</b> <?php echo date("l, F n, Y"); ?></div>
        <article class="story three_col">
        <?php foreach($cats as $cat): ?>
          <?php if ($cat->type != "link"): ?>
              <?php if ($cat->type == "photo"): ?>
                <img src="<?php echo $cat->photos[0]->alt_sizes[2]->url; ?>" alt="" />
                <?php echo $cat->caption; ?>
              <?php elseif ($cat->type == "quote"): ?>
                <?php echo $cat->text; ?>
              <?php elseif ($cat->type == "text"): ?>
                <h2><?php echo $cat->title; ?></h2>
                <?php echo $cat->body; ?>
              <?php endif; ?>
              <hr />
          <?php endif; ?>
        <?php endforeach;?>
        </article>
      </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>