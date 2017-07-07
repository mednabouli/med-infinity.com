(function($){
jQuery.fn.plp = function(options){
	options = $.extend({
		volume: 50,
		playlist: [],
		autostart: false
	}, options);

	var make = function(){
		var $this = $(this);
		var cpl = 0;
		var $audio = new Audio();
		var isrand = false;

		$this.find('.volume').slider({
			animate: true,
			range: 'min',
			value: options.volume,
			min: 0,
			max: 1,
			step: 0.01,
			slide: function(event, ui){
				$audio.volume = ui.value;
			}
		});
		
		$this.find('.long').slider({
			animate: true,
			range: 'min',
			value: 0,
			min: 0,
			max: 60,
			step: 1,
			slide: function(event, ui){
				$audio.currentTime = ui.value;
			}
		});
		
		$audio.addEventListener('canplay', function(_event){
			if($audio.duration){
				$this.find('.all').html('&nbsp;/&nbsp;' + toMinit($audio.duration));
				$this.find('.long').slider({'max':$audio.duration});
			}else{
				$this.find('.all').html('&nbsp;/&nbsp;' + toMinit(options.playlist[cpl].duration));
				$this.find('.long').slider({'max':options.playlist[cpl].duration});
			}
			
			if(options.autostart){
				$audio.play();
				$this.find('.tlb_stop').addClass('isplay');
			}else{
				options.autostart = true;
			}
		});
		
		$audio.addEventListener('ended', function(){
			if(isrand){
				var rand = cpl;
				while(rand == cpl){rand = Math.floor(Math.random() * (options.playlist.length));}
				
				init_track(rand);
			}else{
				if(cpl == options.playlist.length-1){cpl = -1;}
				init_track(cpl+1);
			}
		});

		$audio.addEventListener('timeupdate', function(){
			$this.find('.long').slider({'value':$audio.currentTime});
			$this.find('.current').html(toMinit($audio.currentTime));
		});
		
	
		function toMinit(val){
			val = Number(val);
			var ost = Math.floor(val%60);
			var tm = Math.floor(val/60);
			if(ost < 10){ost = '0'+ost;}
			if(tm < 10){tm = '0'+tm;}
			return tm+':'+ost;
		}
		
		function init_track(i){
			cpl = i;
			$this.find('.playlist span').removeClass('active');
			$this.find('.playlist span:eq('+i+')').addClass('active');
			$audio.src = options.playlist[i].mfile;
			$this.find('.title').html(options.playlist[i].title);
			$this.find('.author').html(options.playlist[i].author);
			$this.find('.cover').attr('src', options.playlist[i].cover);
		}

		
		for(i=0; i < options.playlist.length; i++){
			$this.find('.playlist').append('<span>'+options.playlist[i].author+' - '+options.playlist[i].title+'</span>');
		}
		init_track(cpl);
		
		$this.find('.playlist span').click(function(){
			init_track($(this).index());
		});

		$this.find('.tlb_prev').click(function(){
			if(isrand){
				var rand = cpl;
				while(rand == cpl){rand = Math.floor(Math.random() * (options.playlist.length));}
				
				init_track(rand);
			}else{
				if(cpl == 0){cpl = options.playlist.length;}
				init_track(cpl-1);
			}
			return false;
		});
		
		$this.find('.tlb_stop').click(function(){
			if($audio.paused){
				$audio.play();
				$(this).addClass('isplay');
			}else{
				$audio.pause();
				$(this).removeClass('isplay');
			}
			return false;
		});
		
		$this.find('.tlb_next').click(function(){
			if(isrand){
				var rand = cpl;
				while(rand == cpl){rand = Math.floor(Math.random() * (options.playlist.length));}
				
				init_track(rand);
			}else{
				if(cpl == options.playlist.length-1){cpl = -1;}
				init_track(cpl+1);
			}
			return false;
		});
		
		$this.find('.vol_icon').click(function(){
			$(this).toggleClass('active');
			$this.find('.volume').fadeToggle(100);
			return false;
		});
		
		$this.find('.pl_icon').click(function(){
			$(this).toggleClass('active');
			$this.find('.playlist').fadeToggle(100);
			return false;
		});
		
		$this.find('.while_icon').click(function(){
			if($audio.loop){
				$(this).removeClass('active');
				$audio.loop = false;
			}else{
				$(this).addClass('active');
				$audio.loop = true;
			}
			return false;
		});
		
		$this.find('.rand').click(function(){
			if(isrand){
				$(this).removeClass('active');
				isrand = false;
			}else{
				$(this).addClass('active');
				isrand = true;
			}
			return false;
		});
	};
	return this.each(make); 
};
})(jQuery);