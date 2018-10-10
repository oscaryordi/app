<?php include ("1header.php"); ?>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1;' name='viewport' />
    <style>
      video {
        width: 400px;
        height: 224px;
        border: 5px solid gray;
		background-color:gray;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;

		}

      .video-container {
        display: inline-block;
		text-align:center;
		width: 100%;
		margin: 0 auto;
      }
      
      p {
        font: 10px Arial;
      }
	  
	  img{
	  width: 100px;
	  display: inline-block;
      }
	  h2{
		margin:auto;
		display:inline-block;
		padding-left: 1em;
		vertical-align: middle;
		}
    </style>
<div class="video-container">
	<a>
		<video poster="logo copia.png" controls autoplay preload>
			<source src="video/Version_Corta_APP.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' /></source>
			Your browser does not support HTML5 video.
		</video>
	</a>
</div>
<?php include ("1footer.php"); ?>