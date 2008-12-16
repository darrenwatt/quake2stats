    <div id="footer">
          <a href="http://code.google.com/p/quake2stats/">Q2stats</a> is built using cutting edge technology from the past!<br>
          <a href="http://www.james-lloyd.com">www.james-lloyd.com</a> & <a href="http://www.darrenwatt.com">www.darrenwatt.com</a><br>
          <a href="http://code.google.com/p/quake2stats/">google code site</a>
    </div>
</div>
<?php
if (!empty($googleanalytics)) {
?>
<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("<?php echo $googleanalytics ?>");
pageTracker._initData();
pageTracker._trackPageview();
</script>

<!--End of Google Analytics -->
<?php } ?>
</body>
</html>