<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="sales-content">
    <table>
      <tr>
        <td class="sales-side">
          <section class="sales">
            <h1>Sales from 01/01/18 - 02/15/18</h1>
            <aside class="filter">
              <label>Filter by</label>
              <ul>
                <li>
                  <select>
                    <option>Date Range</option>
                  </select>
                </li>
                <li><input type="date" name="" value="FROM"></li>
                <li><input type="date" name="" value="TO"></li>
                <li><input type="submit" name="" value="FILTER"></li>
              </ul>
            </aside>
            <article>
              <table>
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

              </table>
            </article>
            <div class="pagination">
              <label>Pages:</label>
              <ul>
                <?php
                $page = ($_GET['page']) ?: 1;
                 for ($i=1; $i <= $total_page_count; $i++) { ?>
                  <li><a
                    class="<?php echo ($i == $page) ? 'active' : '' ?>"
                    href="<?php echo base_url('dashboard/sales') . "?page=" . $i ?>"><?php echo $i ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </section>

        </td>
        <td class="current-sales">
          <h4>Current Sales</h4>
          <h3><?php echo $total_sales ?></h3>
        </td>
      </tr>
    </table>
  </div>


</article>
<!-- End of Main Dashboard -->
