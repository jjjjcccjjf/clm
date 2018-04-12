<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="sales-content">
    <table>
      <tr>
        <td class="sales-side">
          <section class="sales">
            <h1>Sales
              <?php if ($_GET['from_date'] && $_GET['to_date']): ?>
                from
                <?php echo $this->input->get('from_date') ?> -
                <?php echo $this->input->get('to_date') ?>
              <?php endif; ?>
            </h1>
            <aside class="filter">
              <label>Filter by</label>
              <ul>
                <li>
                  <select>
                    <option>Date Range</option>
                  </select>
                </li>
                <form method="get">
                  <input type="hidden" name="page" value="1">
                  <li><input type="date" name="from_date" value="<?php echo $this->input->get('from_date') ?>"></li>
                  <li><input type="date" name="to_date" value="<?php echo $this->input->get('to_date') ?>"></li>
                  <li><input type="submit" name="" value="FILTER"></li>
                </form>
              </ul>
            </aside>
            <article>
              <table>
                <?php if ($sales): ?>

                  <tr>
                    <td>Project</td>
                    <td>Sales Amount</td>
                    <td>Date</td>
                  </tr>
                  <?php foreach ($sales as $key => $value): ?>

                    <tr>
                      <td><?php echo $value->project_name ?></td>
                      <td>Php <?php echo $value->sales_amount_f ?></td>
                      <td><?php echo $value->date_f ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3" style="width:100%; text-align:center">No sales data within this period.
                      <a style="color:gold;text-decoration:underline"
                      href="<?php echo base_url('dashboard/sales') ?>">View all sales
                    </a>
                  </td>
                </tr>
              <?php endif; ?>

            </table>
          </article>
          <?php if ($sales): ?>
            <div class="pagination">
              <label>Pages:</label>
              <ul>
                <?php
                $page = ($_GET['page']) ?: 1;
                for ($i=1; $i <= $total_page_count; $i++) { ?>
                  <li><a
                    class="<?php echo ($i == $page) ? 'active' : '' ?>"
                    href="<?php echo base_url('dashboard/sales')
                    . "?page=" . $i
                    . "&from_date=" . $this->input->get('from_date')
                    . "&to_date=" . $this->input->get('to_date')
                    ?>"><?php echo $i ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            <?php endif; ?>

          </section>

        </td>
        <td class="current-sales">
          <h4>Total Overall Sales</h4>
          <h3><?php echo $total_overall_sales ?></h3>
          <br>
          <?php if (@$_GET['from_date'] && @$_GET['to_date']): ?>
            <h4>Current Sales
              <br>
              <?php echo $this->input->get('from_date') ?> -
              <?php echo $this->input->get('to_date') ?>
            </h4>
            <h3><?php echo $total_sales ?></h3>
          <?php endif; ?>
        </td>
      </tr>
    </table>
  </div>


</article>
<!-- End of Main Dashboard -->
