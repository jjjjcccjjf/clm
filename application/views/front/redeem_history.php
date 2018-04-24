<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="sales-content">
    <table>
      <tr>
        <td class="sales-side">
          <section class="sales">
            <h1>Redeem History
              <?php if ($flash_msg = $this->session->flash_msg_redeem): ?>
                <br>
                <sub style="color:<?php echo $flash_msg['color'] ?>;font-weight:bold">
                  <?php echo $flash_msg['message']; ?></sub>
                <?php endif; ?>
            </h1>
            <aside class="filter">
              <label>Filter by</label>
              <ul>
                <li>
                  <select class="select_filter">
                    <option value="date_range_filter">Date Range</option>
                  </select>
                </li>
                <form method="get" class="date_range_filter">
                  <input type="hidden" name="page" value="1">
                  <li><input type="date" name="from_date" value="<?php echo $this->input->get('from_date') ?>"></li>
                  <li><input type="date" name="to_date" value="<?php echo $this->input->get('to_date') ?>"></li>
                  <li><input type="submit" name="" value="FILTER"></li>
                </form>
              </ul>
            </aside>
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
                      <td><?php echo $value->cost ?> Pts.</td>
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
