<?php
include "config.php";
include "templates/templates.php";

$templates = Template::getAll();

// Find all templates with their own navigation item
$navItems = [];
foreach($templates as $index=>$template)
{
  if ($template->isNavigation)
    $navItems[$index] = $template;
}
?>
<!doctype html>
<html class="no-js" lang="en-EN">
<head>
  <meta charset="utf-8">
  <base href="/">
  <title>Planning Cards</title>
  <meta name="description" content="Planning Cards is online implementation of Planning Poker&#174; for Scrum Masters and their teams. It's used to determine the complexity of Scrum Stories.">  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width initial-scale=1 maximum-scale=1 user-scalable=no">
  
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#222222">
  <meta name="application-name" content="Planning Cards">
  <meta name="msapplication-TileColor" content="#222222">
  <meta name="theme-color" content="#222222">
    
  <script src="/js/modernizr-2.8.3.min.js"></script>
  
  <!-- Style sheets -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/scrumonline.css">

  <!-- Pretty cookie consent and styling -->
  <?php //include("templates/cookie_notice.php") ?>
</head>
<body ng-app="scrum-online">
<!--[if lt IE 8]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--Github Fork Badge
<div class="github-fork-ribbon-wrapper hidden-xs">
  <div class="github-fork-ribbon">
    <a target="_blank" href="https://github.com/gabrielbarr0s/scrumonline">Fork me on GitHub</a>
  </div>
</div>
-->

<!-- Top navigation bar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    	<a class="navbar-brand" href="/">Planning Cards</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <?php foreach($navItems as $navItem): ?>
        <li data-toggle="collapse" data-target=".navbar-collapse.in"><a href="<?php echo $navItem->link ?>"><?php echo $navItem->navigationTag ?></a></li>
      <?php endforeach; ?>
      </ul>
    </div> <!--/.nav-collapse -->
  </div>
</nav>

<!-- Add your site or application content here -->
<div class="container-fluid main wrapper" ng-view></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-cookies.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.min.js"></script>
<script src="https://cdn.rawgit.com/showdownjs/showdown/1.8.6/dist/showdown.min.js"></script>
<script src="/js//bootstrap.min.js"></script>
<script src="/js/J2M.js"></script>
<script type="text/javascript">
  var cardSets = [
<?php foreach($cardSets as $key=>$cardSet) { ?>
    { set: <?= $key ?>, cards: <?= json_encode($cardSet) ?>  },
<?php } ?>
  ];
</script>
<script src="/js/main.js"></script>
<?php foreach($plugins as $plugin) {?>
<script src="/js/<?= strtolower($plugin) ?>-plugin.js"></script>
<?php } ?>
  
<!-- Templates of the page -->
<?php
  foreach($templates as $template)
  {
     $template->render();
  }
?>
</body>
</html>