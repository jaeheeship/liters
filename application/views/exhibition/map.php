<script src="http://openapi.map.naver.com/openapi/naverMap.naver?ver=2.0&key=<?=$NAVER_MAP_API_KEY?>"></script>
<div id="map" style="width:100%;height:200px;"></div>

    <script>
			nhn.api.map.setDefaultPoint('LatLng') ; 
			var oPoint = new nhn.api.map.LatLng(37,127) ; 
			var oMap = new nhn.api.map.Map('map', { 
			    point : oPoint  
			});
			
			var oSize = new nhn.api.map.Size(28,37) ;
			var oOffset = new nhn.api.map.Size(14,37) ;
			var oIcon = new nhn.api.map.Icon('http://static.naver.com/maps2/icons/pin_spot2.png', oSize,oOffset) ; 
			
			var oMarker = new nhn.api.map.Marker(oIcon, {title :"안녕하세요." }) ; 
			oMarker.setPoint(oPoint) ; 
			oMap.addOverlay(oMarker) ; 
			
			var oLabel = new nhn.api.map.MarkerLabel(); 
			oMap.addOverlay(oLabel) ; 
			
			oLabel.setVisible(true,oMarker) ; 
    </script>
