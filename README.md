Yii2 MONOLOG
================================

1. 安装

   composer require alan/yii2-monolog

   

2. 配置

   ```php
   'log' => [
               'traceLevel' => YII_DEBUG ? 3 : 0,
               'flushInterval' => 10,
               'targets' => [
                   [
                       'class' => 'common\log\MonologComponent',
                       'levels' => ['error', 'warning', 'info', 'trace', 'profile'],
                       'except' => [
                           'yii\base\*',
                       ],
                       'exportInterval' => 1,
                       'logVars' => [],
                       'channels' => [
                           'main' => [
                               'handler' => [
                                   [
                                       'class' => 'Monolog\Handler\StreamHandler',
                                       'stream' => '@app/runtime/logs/log_' . date('Y-m-d') . '.log',
                                       'level' => 'debug',
                                       'formatter' => [
                                           'class' => 'Monolog\Formatter\LogstashFormatter',
                                           'applicationName' => 'shanghu-backend',
                                           'systemName' => 'shanghu-test',
                                       ],
                                   ],
                               ],
                               'processor' => [
                                   \yii2\monolog\LogIdProcessor::instance(), //生成logId
                               ],
                           ],
                       ],
                   ]
               ],
           ],
   ```

3. 日志写入无变更

4. 如在控制台使用则需要手动刷新logId，手动调用如何方法

   ```php
   \yii2\monolog\LogIdProcessor::instance()->refresh();
   ```

   