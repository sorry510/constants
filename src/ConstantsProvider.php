<?php

namespace Sorry510;

use Illuminate\Support\ServiceProvider;
use Sorry510\Constants\Constants;

/**
 * 常量注解注册
 *
 * @Author sorry510 491559675@qq.com
 */
class ConstantsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Constants::class, function ($app) {
            return new Constants;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->init();
    }

    /**
     * 将所有常量注入到实例
     * @Author sorry510 491559675@qq.com
     * @DateTime 2021-04-19
     * @return void
     */
    protected function init()
    {
        /**
         * @var Constants
         */
        $constants = app(Constants::class);
        // 读取 Constants 目录下的所有文件
        if (is_dir(app_path('Constants'))) {
            foreach (new \DirectoryIterator(app_path('Constants')) as $fileInfo) {
                if ($fileInfo->isDot() || $fileInfo->isDir() || $fileInfo->getExtension() !== 'php') {
                    continue;
                }
                $reflClass = new \ReflectionClass("\\App\\Constants\\" . $fileInfo->getBasename('.php'));
                $reflectionConstants = $reflClass->getReflectionConstants(); // 获取反射类的所有常量，没有返回空数组
                foreach ($reflectionConstants as $reflectionConstant) {
                    $doc = $reflectionConstant->getDocComment();
                    $value = $reflectionConstant->getValue();
                    preg_match('/@Message\("(.*)"\)/', $doc, $result); // 匹配注释信息
                    if (!empty($result)) {
                        $message = end($result);
                        $constants->setMessage($value, $message);
                    }
                }
            }
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/stub/ErrorCode.php' => app_path('/Constants/ErrorCode.php'),
        ], 'constant');
    }
}
