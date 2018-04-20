<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="sales-content">
    <table>
      <tr>
        <td class="sales-side">
          <section class="sales">
            <h1>Redeem History
              <?php if ($_GET['from_date'] && $_GET['to_date']): ?>
                from
                <?php echo $this->input->get('from_date') ?> -
                <?php echo $this->input->get('to_date') ?>
              <?php endif; ?>
            </h1>
            <article>
              <table>
                <?php if ($redeem_history): ?>
                  <tr>
                    <td>Item</td>
                    <td>Cost</td>
                    <td>Date Redeemed</td>
                  </tr>
                  <?php foreach ($redeem_history as $key => $value): ?>

                    <tr>
                      <td><?php echo $value->title ?></td>
                      <td>Php <?php echo $value->cost ?></td>
                      <td><?php echo $value->created_at ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3" style="width:100%; text-align:center">No redeemed items yet.
                      <a style="color:gold;text-decoration:underline"
                      href="<?php echo base_url('dashboard/rewards') ?>">View all rewards
                    </a>
                  </td>
                </tr>
              <?php endif; ?>

            </table>
          </article>
          <?php if ($redeem_history): ?>
            <div class="pagination">
              <label>Pages:</label>
              <ul>
                <?php
                $page = ($_GET['page']) ?: 1;
                for ($i=1; $i <= $total_redeemed; $i++) { ?>
                  <li><a
                    class="<?php echo ($i == $page) ? 'active' : '' ?>"
                    href="<?php echo base_url('dashboard/redeem_history')
                    . "?page=" . $i;
                    ?>"><?php echo $i ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            <?php endif; ?>

          </section>

        </td>
        <td class="current-sales">
          <h4>Total Points Accumulated</h4>
          <h3><?php echo $gross_points ?></h3>
          <br>
          <h4>Total Points Spent</h4>
          <h3><?php echo $points_spent ?></h3>
        </td>
      </tr>
    </table>
  </div>


</article>
<!-- End of Main Dashboard -->
