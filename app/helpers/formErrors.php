<?php
if (count($errors) > 0) {
  ?>
  <div class="msg error" style="
  color: #884b4b;
  padding:12px;
  border: 1px solid #884b4b;
  border-radius:7px;
  background: #f5bcbc;

">
    <?php foreach ($errors as $key => $values) { ?>
      <li>
        <?php echo $values; ?>
      </li>
    <?php } ?>
  </div>
  <?php

} ?>