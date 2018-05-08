<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper">
    <h1><?php echo $project->title ?></h1>
    <div class="video-container" >
      <img src="<?php echo $project->image_url ?>" alt="">

    </div>
    <article class="content-container" >
      <p><?php echo $project->description ?></p>
    </article>
  </div>
</article>
