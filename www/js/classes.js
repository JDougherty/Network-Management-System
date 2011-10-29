function Mouse()
{
	this.X = 0, this.Y = 0;
	this.lastX = 0, this.lastY = 0;
	this.diffX = 0, this.diffY = 0;
	this.scale = 1;
	this.down = false;
	this.resizing = false;
	this.resizingCorner = -1;
}

Mouse.prototype =
{
	update: function(X, Y)
	{
		this.lastX = this.X, this.lastY = this.Y;
		this.X = X, this.Y = Y;
		this.diffX = (this.X - this.lastX) * this.scale, this.diffY = (this.Y - this.lastY) * this.scale;
	},
	cursor: function(type)
	{
		switch (type)
		{
			case 0:
				return 'nw-resize';
			case 1:
				return 'n-resize';
			case 2:
				return 'ne-resize';
			case 3:
				return 'w-resize';
			case 4:
				return 'e-resize';
			case 5:
				return 'sw-resize';
			case 6:
				return 's-resize';
			case 7:
				return 'se-resize';
			default:
				return 'auto';
		}
	}
}

function Objects()
{
	this.list = []
}

Objects.prototype =
{
	add: function(object)
	{
		this.list.push(object);
	},
	update: function(i, args)
	{
		this.list[i].update(args);
	},
	draw: function(canvas)
	{
		for (i = 0; i < this.list.length; i++)
		{
			this.list[i].draw(canvas);
		}
	},
	getClickedID: function(canvas, context, x, y)
	{
		clear(canvas, context);
		for (i = this.list.length - 1; i >= 0; i--)
		{
			this.list[i].draw(canvas);
			var imageData = context.getImageData(x, y, 1, 1);
			
			if (imageData.data[3] > 0)
			{
				return i;
			}
		}
		return -1;
	},
	getClicked: function(canvas, context, x, y)
	{
		id = this.getClickedID(canvas, context, x, y);
		return (id < 0) ? null : this.list[id];
	}
}

function ResizableObject(args)
{
	$.extend(this, args);
}

ResizableObject.prototype = 
{
	resize: function(resizingCorner, diffX, diffY)
	{
		switch (resizingCorner)
		{
			case 0:
				this.x += diffX / 2;
				this.y += diffY / 2;
				this.width -= diffX;
				this.height -= diffY;
				break;
			case 1:
				this.y += diffY / 2;
				this.height -= diffY;
				break;
			case 2:
				this.x += diffX / 2;
				this.y += diffY / 2;
				this.width += diffX;
				this.height -= diffY;
				break;
			case 3:
				this.x += diffX / 2;
				this.width -= diffX;
				break;
			case 4:
				this.x += diffX / 2;
				this.width += diffX;
				break;
			case 5:
				this.x += diffX / 2;
				this.y += diffY / 2;
				this.width -= diffX;
				this.height += diffY;
				break
			case 6:
				this.y += diffY / 2;
				this.height += diffY;
				break;
			case 7:
				this.x += diffX / 2;
				this.y += diffY / 2;
				this.width += diffX;
				this.height += diffY;
				break;
		}
	}
}

function BoundingBox(args)
{
	$.extend(this, args);
	
	var x = 0,  y = 0;
	
	this.objects = new Objects();
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
	this.objects.add(new Box({x:x,y:y,height:8,width:8,color:this.color2}));
}

BoundingBox.prototype = 
{
	update: function(args)
	{
		$.extend(this, args);
		
		var x = this.x,  y = this.y;
		var height = this.height + 10, width = this.width + 10;
		var height2 = height / 2, width2 = width / 2;
	
		this.objects.update(0, {x: x - width2,		y: y - height2});
		this.objects.update(1, {x: x,				y: y - height2});
		this.objects.update(2, {x: x + width2,		y: y - height2});
		this.objects.update(3, {x: x - width2,		y: y});
		this.objects.update(4, {x: x + width2,		y: y});
		this.objects.update(5, {x: x - width2,		y: y + height2});
		this.objects.update(6, {x: x,				y: y + height2});
		this.objects.update(7, {x: x + width2,		y: y + height2});
	},
	draw: function(canvas)
	{
		var x = this.x,  y = this.y;
		var height = this.height + 10, width = this.width + 10;
		var height2 = height / 2, width2 = width / 2;
		
		canvas.drawLine({
			strokeStyle: this.color,
			strokeWidth: "2",
			x1: x - width2, y1: y - height2,
			x2: x + width2, y2: y - height2,
			x3: x + width2, y3: y + height2,
			x4: x - width2, y4: y + height2,
			x5: x - width2, y5: y - height2,
		});
		
		this.objects.draw(canvas);
	},
	getCornerID: function(canvas, context, x, y)
	{
		return this.objects.getClickedID(canvas, context, x, y);
	}
}

function Box(args)
{
	$.extend(this, args);
}

Box.prototype =
{
	update: function(args)
	{
		$.extend(this, args);
	},
	draw: function(canvas)
	{		
		canvas.drawRect({
			fillStyle: this.color,
			x: this.x, y: this.y,
			width: this.width,
			height: this.height,
			fromCenter: true
		});
	}
}

function Router(args)
{
	$.extend(this, args);
}

Router.prototype =
{
	update: function(args)
	{
		$.extend(this, args);
	},
	draw: function(canvas)
	{
		var x = this.x,  y = this.y;
		var height = this.height, width = this.width;
		var multX = width / 100, multY = height / 60;
		
		var height2 = height / 2;
		var height4 = height / 4;
		var height8 = height / 8;
		var width2 = width / 2;
		
		canvas.drawRect({
			fillStyle: this.color,
			strokeStyle: "#FFFFFE",
			strokeWidth: "2",
			x: x, y: y,
			width: width,
			height: height2,
			fromCenter: true
		});
		canvas.drawEllipse({
			fillStyle: this.color,
			strokeStyle: "#FFFFFE",
			strokeWidth: "2",
			x: x, y: y + height4,
			width: width, height: height2,
			fromCenter: true
		});
		canvas.drawRect({
			fillStyle: this.color,
			x: x, y: y,
			width: width-2,
			height: height2,
			fromCenter: true
		});
		canvas.drawEllipse({
			fillStyle: this.color,
			strokeStyle: "#FFFFFE",
			strokeWidth: "2",
			x: x, y: y - height4,
			width: width, height: height2,
			fromCenter: true
		});
		canvas.drawLine({
			fillStyle: "#FFFFFE",
			x1: x + -42.93 * multX, y1: y + -19.51 * multY,
			x2: x + -38.05 * multX, y2: y + -23.38 * multY,
			x3: x + -15.50 * multX, y3: y + -19.51 * multY,
			x4: x + -13.31 * multX, y4: y + -21.44 * multY,
			x5: x + -9.61 * multX, y5: y + -16.98 * multY,
			x6: x + -23.24 * multX, y6: y + -14.12 * multY,
			x7: x + -21.72 * multX, y7: y + -15.81 * multY,
		});
		canvas.drawLine({
			fillStyle: "#FFFFFE",
			x1: x + -18.44 * multX, y1: y + -2.42 * multY,
			x2: x + -4.30 * multX, y2: y + -3.94 * multY,
			x3: x + -7.59 * multX, y3: y + -4.95 * multY,
			x4: x + 1.42 * multX, y4: y + -11.18 * multY,
			x5: x + -6.16 * multX, y5: y + -12.61 * multY,
			x6: x + -13.23 * multX, y6: y + -6.63 * multY,
			x7: x + -18.44 * multX, y7: y + -7.81 * multY,
		});
		canvas.drawLine({
			fillStyle: "#FFFFFE",
			x1: x + 12.02 * multX, y1: y + -8.75 * multY,
			x2: x + 8.57 * multX, y2: y + -13.45 * multY,
			x3: x + 21.95 * multX, y3: y + -16.39 * multY,
			x4: x + 20.35 * multX, y4: y + -14.37 * multY,
			x5: x + 42.65 * multX, y5: y + -10.84 * multY,
			x6: x + 37.60 * multX, y6: y + -7.56 * multY,
			x7: x + 15.22 * multX, y7: y + -11.09 * multY,
		});
		canvas.drawLine({
			fillStyle: "#FFFFFE",
			x1: x + 7.90 * multX, y1: y + -16.73 * multY,
			x2: x + 15.14 * multX, y2: y + -22.70 * multY,
			x3: x + 18.09 * multX, y3: y + -21.78 * multY,
			x4: x + 18.09 * multX, y4: y + -27 * multY,
			x5: x + 4.62 * multX, y5: y + -24.39 * multY,
			x6: x + 8.82 * multX, y6: y + -23.97 * multY,
			x7: x + 1.42 * multX, y7: y + -18.08 * multY,
		});
	},
}

Router.prototype = $.extend(
	{},
	ResizableObject.prototype,
	Router.prototype
);