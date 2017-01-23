<?php $user = $session->get('user'); ?>
<div><p><?php print $_ripple['grade']."  ".$_ripple['name']; ?></p><p><?php print $_ripple['tim'] ?></P>
<pre><?php print $_ripple['content']; ?></pre>
  <?php if($_ripple['id'] == $user['id'] || $user['id'] == 'admin'): ?>
    <a href="<?php print $base_url; ?>/ripple/delete/<?php print $_ripple['rnum']; ?>/board/<?php print $_num; ?>">[삭제]</a>
  <?php endif; ?>
</div>
