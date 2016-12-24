var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var fs = require('fs');
var exec = require('child_process').exec;
var moment = require('moment'),
    now = moment().format("YYMMDDHHmm");

function start_driver(url) {
    driver = new webdriver.Builder()
    .withCapabilities(webdriver.Capabilities.phantomjs())
    .build();
    driver.manage().window().setSize(320, 640);
    driver.get(url);
}

function screen_shot(filename) {
    driver.takeScreenshot().then(function (base64Image) {
        var decodedImage = new Buffer(base64Image, 'base64');
        fs.writeFile('img_p/'+filename+'-'+now+'.jpg', decodedImage, function(err) {});
    });
    exec('sh imagediff.sh '+filename+' img_p', function(err, stdout, stderr){
        if (stdout) {
            console.log(stdout);
        }
    });
}

/**
* 現在のURLが期待値と一致していなければ、エラーを吐く
* @param  {string} expect [期待値のURL]
* @param  {string} test_case  [エラー箇所]
* @return {string} test_case  [エラー箇所]
*/
function expect_url(expect, test_case) {
    screen_shot(test_case);
    driver.getCurrentUrl().then(function(url){
        if (url != expect) {
            console.log(test_case+'：エラーが起きています。');
            console.log('現在のurl:' +url);
            console.log('期待値のurl:' +expect);
        } else {
            console.log(test_case+'：テスト成功');
        }
    });
}

/**
* パセリのバリデーションが走っているかのチェック
* @param  {sel}  バリデーション対象セレクター
* @param  {string} test_case [description]
* @param  {string} expect [期待する値]
* @return {error}  test_case テストの可否、エラーメッセージ
*/
function expect_parsley_error(sel, test_case, expect) {
    screen_shot(test_case);
    driver.findElement(By.css(sel+" + .parsley-errors-list")).getText().then(function(text) {
        if (text == expect) {
            console.log(test_case+'：テスト成功');
        } else {
            console.log(test_case+'：半分成功');
            console.log('エラーメッセージ:'+text);
            console.log('テストの期待値:'+expect);
        }
    }, function (error) {
        console.log(test_case+'：テスト失敗');
    });
}

/**
* 不要なバリデーションが走っていないかのチェック
* @param  {sel}  バリデーション対象セレクター
* @param  {string} test_case [description]
* @return {error}  test_case  [エラー箇所]
*/
function expect_not_error(sel, test_case) {
    screen_shot(test_case);
    driver.findElement(By.css(sel+" + .parsley-errors-list")).getText().then(function(text) {
        console.log(test_case+'：テスト失敗');
        console.log('エラーメッセージ:'+text);
    }, function (error) {
        console.log(test_case+'：テスト成功');
    });
}

/**
* 期待する値に変換されているかの確認
* @param  {sel}  バリデーション対象セレクター
* @param  {string} test_case [description]
* @param  {string} expect [期待する値]
* @return {error}  test_case  [エラー箇所]
*/
function expect_parse(sel, test_case, expect) {
    screen_shot(test_case);
    driver.findElement(By.id(sel)).getAttribute('value').then(function(text) {
        if (text == expect) {
            console.log(test_case+'：テスト成功');
        } else {
            console.log(test_case+'：テスト失敗');
            console.log('エラーメッセージ:'+text);
            console.log('テストの期待値:'+expect);
        }
    }, function (error) {
        console.log(test_case+'：テスト失敗');
    });
}

/**
 * 現在のURLが期待値と一致していなければ、エラーを吐く
 * @param  {string} expect [期待値のURL]
 * @param  {string} test_case  [エラー箇所]
 * @return {string} test_case  [エラー箇所]
 */
function expect_url(expect, test_case) {
    screen_shot(test_case);
    driver.getCurrentUrl().then(function(url) {
        if (url != expect) {
            console.warn(test_case + '：エラーが起きています。');
            console.log('現在のurl:' + url);
            console.log('期待値のurl:' + expect);
        } else {
            console.log(test_case + '：テスト成功');
        }
    });
}


/**
* 正常にHTTPリクエストを返せているか
* 正常にページネーションが動いているか
*/
start_driver('http://192.168.33.90/');
// driver.findElement(By.tagName("button")).click();
driver.quit();
