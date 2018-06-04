<article class="maincontent" id="page-content-wrapper">
  <div class="projects-inner">
    <h1><?php echo $project->title ?></h1>
    <p><?php echo $project->address ?></p>

    <section class="prjinner-hldr clearfix">
      <aside>
        <figure>
          <img src="<?php echo $project->image_url ?>">
        </figure>
        <article>
          <ul class="listn pad-0">
            <li>
              <h5>Total Land Area</h5>
              <p><?php echo $project->total_land_area ?></p>
            </li>
            <li>
              <h5>Phases</h5>
              <p><?php echo $project->phases ?></p>
            </li>
            <li>
              <h5>Status</h5>
              <p><?php echo $project->status ?></p>
            </li>
          </ul>
        </article>

      </aside>
      <article>
        <div class="tab">
          <button class="tablinks active" onclick="openTab(event, 'updates')" >Latest Updates</button>
          <button class="tablinks" onclick="openTab(event, 'gallery')"  >Gallery</button>
          <button class="tablinks" onclick="openTab(event, 'download')">Downloadables</button>
        </div>

        <div id="updates" class="tabcontent updates">

          <?php foreach ($latest_updates as $key => $value): ?>
            <ul class="pad-0 listn update-list">
              <h5><?php echo date_format(date_create($key),"F d, Y"); ?></h5>

              <?php foreach ($latest_updates[$key] as $u): ?>
                <li>
                  <figure>
                    <a href="<?php echo $u->image_url ?>" target="_blank">
                      <img src="<?php echo $u->image_url ?>">
                    </a>
                  </figure>
                </li>
              <?php endforeach; #end individual update arr ?>
            </ul>

          <?php endforeach; #end updatelist ?>

        </div>

      </article>
    </section>

  </div>


</article>
