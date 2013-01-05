var points = [{
    'x' : 20,
    'y' : 40
}, {
    'x' : 100,
    'y' : 200
}, {
    'x' : 125,
    'y' : 40
}];

// 初始canvas物件
var ctx = document.getElementById('test').getContext('2d');

// 設定文字置中、靠中間對齊
ctx.textAlign = 'center';
ctx.textBaseline = 'middle';
ctx.lineJoin = 'round';

// 設定點寬度、線段寬度
var circleSize = 10;
var lineWidth = 3;

/**
 * 繪製點
 * @param {Object} x
 * @param {Object} y
 * @param {Object} text
 */
function drawPoint(x, y, text) {
    // 圓框部份
    ctx.beginPath();
    ctx.fillStyle = 'black';
    ctx.arc(x, y, circleSize, 0, Math.PI * 2, true);
    ctx.fill();

    // 文字部份
    ctx.font = '12px Arial';
    ctx.fillStyle = 'white';
    ctx.fillText(text, x, y);
};

/**
 * 繪製線
 * @param {Object} x1
 * @param {Object} y1
 * @param {Object} x2
 * @param {Object} y2
 */
function drawLine(x1, y1, x2, y2) {
    ctx.beginPath();
    ctx.lineWidth = lineWidth;
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.stroke();
};

/**
 * 繪製全部的結果
 */
function drawAll() {
    var lineVertex
    for ( i = 0; i < points.length - 1; i++) {
        drawPoint(points[i].x, points[i].y, i + 1);
        lineVertex = adjustLineLength(points[i], points[i + 1]);
        drawLine(lineVertex.x1, lineVertex.y1, lineVertex.x2, lineVertex.y2);
    }

    drawPoint(points[points.length - 1].x, points[points.length - 1].y, points.length);
};

/**
 * 調整線段長度，避免過長
 * @param {Object} point1
 * @param {Object} point2
 */
function adjustLineLength(point1, point2) {
    var p = {};

    if ((point2.x - point1.x) > 0) {
        p.x1 = point1.x + circleSize / 2 - 1;
        p.x2 = point2.x - circleSize / 2 + 1;
    } else {
        p.x1 = point1.x - circleSize / 2 + 1;
        p.x2 = point2.x + circleSize / 2 - 1;
    }

    if ((point2.y - point1.y) > 0) {
        p.y1 = point1.y + circleSize / 2 - 1;
        p.y2 = point2.y - circleSize / 2 + 1;
    } else {
        p.y1 = point1.y - circleSize / 2 + 1;
        p.y2 = point2.y + circleSize / 2 - 1;
    }

    return p;
}