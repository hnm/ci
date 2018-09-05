;jQuery(document).ready(function($) {
	var jqElemsPlayer = $(".ci-video");
	if (jqElemsPlayer.length === 0) return;
	(function() {
		YoutubeVideoItem = function(jqElemDivContainer) {
			this.jqElemDivContainer = jqElemDivContainer;
			this.jqElemPlayer = $("<div/>").appendTo(jqElemDivContainer);
			this.player = null; 
		}
		
		YoutubeVideoItem.prototype.initPlayer = function() {
			this.player = new YT.Player(this.jqElemPlayer.get(0), {
				width: this.jqElemDivContainer.data("width"),
				height: this.jqElemDivContainer.data("height"),
				videoId: this.jqElemDivContainer.data("video-id"),
				playerVars: {rel: 0},
				showInfo: 0
			});
			this.jqElemDivContainer.children(":first").get(0).className += " embed-responsive-item";
		};
		
		var youtubeVideoItems = [];
		
		jqElemsPlayer.each(function() {
			youtubeVideoItems.push(new YoutubeVideoItem($(this)));
		});
		
		window.onYouTubeIframeAPIReady = function() {
			for (var i in youtubeVideoItems) {
				youtubeVideoItems[i].initPlayer();
			}
		}
		
		var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	})();
});