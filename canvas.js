// 初始canvas物件
var ctx = document.getElementById('paintArea').getContext('2d');

// 設定文字置中、靠中間對齊
ctx.textAlign = 'center';
ctx.textBaseline = 'middle';
ctx.lineJoin = 'round';

// 設定點旅行點半徑、線段寬度
var circleSize = 10;
var lineWidth = 2;

/**
 * 繪製全部的結果
 */
function drawAll() {
    var lineVertex
    for ( i = 0; i < route.length - 1; i++) {
        drawPoint(points[route[i]][0], points[route[i]][1], i + 1, points[route[i]].coordinate);
        lineVertex = adjustLineLength(points[route[i]], points[route[i + 1]]);
        drawLine(lineVertex.x1, lineVertex.y1, lineVertex.x2, lineVertex.y2);
    }

    // 繪製最後點
    drawPoint(points[route[route.length - 1]][0], points[route[route.length - 1]][1], route.length, points[route[route.length - 1]].coordinate);
};

/**
 * 繪製點
 * @param {Object} x
 * @param {Object} y
 * @param {Object} order
 * @param {String} coordinate
 */
function drawPoint(x, y, order, coordinate) {
    // 圓點填滿部份
    ctx.beginPath();
    ctx.fillStyle = 'white';
    ctx.arc(x, y, circleSize, 0, Math.PI * 2, true);
    ctx.fill();

    // 文字部份，起點跟終點做不同的樣式設計
    if (order == 1) {
        ctx.font = '16px Arial';
        ctx.fillStyle = 'blue';
    } else if (order == route.length) {
        ctx.font = '16px Arial';
        ctx.fillStyle = 'red';
    } else {
        ctx.font = '12px Arial';
        ctx.fillStyle = '#363363';
    }
    ctx.fillText('[' + order + ']' + coordinate, x, y);
};

/**
 * 繪製路徑
 * @param {Object} x1
 * @param {Object} y1
 * @param {Object} x2
 * @param {Object} y2
 */
function drawLine(x1, y1, x2, y2) {
    ctx.beginPath();
    ctx.strokeStyle = '#9A9A9A';
    ctx.lineWidth = lineWidth;
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.stroke();
};

/**
 * 調整線段長度，避免過長
 * @param {Object} point1
 * @param {Object} point2
 */
function adjustLineLength(point1, point2) {
    var p = {};
    if ((point2[0] - point1[0]) > 0) {
        p.x1 = point1[0] + circleSize / 2 - 1;
        p.x2 = point2[0] - circleSize / 2 + 1;
    } else {
        p.x1 = point1[0] - circleSize / 2 + 1;
        p.x2 = point2[0] + circleSize / 2 - 1;
    }

    if ((point2[1] - point1[1]) > 0) {
        p.y1 = point1[1] + circleSize / 2 - 1;
        p.y2 = point2[1] - circleSize / 2 + 1;
    } else {
        p.y1 = point1[1] - circleSize / 2 + 1;
        p.y2 = point2[1] + circleSize / 2 - 1;
    }

    return p;
}