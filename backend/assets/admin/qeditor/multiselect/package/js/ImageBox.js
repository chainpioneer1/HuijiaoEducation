/**
 * ImageBox
 * @param belong 是否英雄
 **/
function ImageBox(pointx,pointy){
	base(this,LSprite,[]);
	var self = this;
	self._index = 0;
	self.pointx = pointx;
	self.pointy = pointy;
    self.bitmap = new LBitmap(new LBitmapData(imglist["hd5_image"],0,0,105,100));
    self.addChild(self.bitmap);
    self.visible = false;
};
ImageBox.prototype.setImageData = function(index){
	var self = this;
	self._index = index;
	if(index > 0){
		self.bitmap.bitmapData.x = (index - 1) * 105;
		self.alpha = 1;
		self.visible = true;
	}else{		
		self.visible = false;	
	}
};