## 站点简介

##### 启程

上班时闲逛 Laravel 社区发现了一个很牛的个人博客项目[techflowing-Blog](https://github.com/techflowing/Blog)，就把项目 clone 了，然后部署成功、运行，发现自己的个人博客网站瞬间弱爆了。然后便想着要不然把自己原来的博客网站给干掉吧，然后基于[techflowing-Blog](https://github.com/techflowing/Blog)重新开发一个适合自己的个人博客网站。


##### 改造

* 升级 [Laravel](https://learnku.com/docs/laravel/8.x) 框架为 8.*
* 将 [Laravel-admin](https://laravel-admin.org/) 改成 [Dcat Admin](https://learnku.com/docs/dcat-admin/2.x)
* 本地线上将采用统一环境使用 [Laravel Sail](https://learnku.com/docs/laravel/8.x/sail/9789)
* 打造一个适合自己的博客主题（这个放在最后是因为自己前端知识比较薄弱）


## 功能模块

#### 欢迎页面

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/welcome.png)

#### 博客站

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/blog.png)

博客文章列表根据知识库单篇文章自动生成，非单独书写，功能包含：文章列表，文章分类列表，个人信息展示，文章数量统计，列表分页等

#### 知识库

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/wiki.png)

知识库模块为本网站的核心功能，也是完成此站点的最初目的，之前也曾尝试过一些类似 hexo 的静态博客站点，但苦于知识难成体系脉络，分布比较杂乱；笔记应用也曾经尝试过很多，也都有些不满意的地方，比如印象笔记不能无限分级之类的，所以才有了此站点，用于作者的知识学习、记录、积累、分享

#### 思维导图

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/xmind.png)

思维导图模块基于百度开源的 [KityMinder](https://github.com/fex-team/kityminder)，满足在线编辑、云端同步的功能

#### 导航站

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/navigation.png)

导航站模块类似一个网络收藏夹，会记录一些自己常用的地址，以及非常酷的站点

#### 留言板

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/guestbook.png)

留言板模块主要是提供一个可交流的窗口&平台，知识库和博客站单篇文章未开发评论系统，所以基于 [Valine](https://valine.js.org/) 最小成本的添加了此模块以便于提供可能需要的交流方式

#### 关于

![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/about.png)

关于模块用于设置一些网站信息，例如：关于我、关于本站、联系作者等，还包含了简单的页面访问统计

#### 后台管理

配置导航站地址分类
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222114.png)

配置导航站地址列表
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222127.png)

管理Wiki项目列表
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222140.png)

具体 Wiki 项目内容编辑页面，支持拖动排序、文章组织位置变更等
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011224819.png)

配置思维导图
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222202.png)

思维导图后台编辑
![](https://github.com/techflowing/Blog/blob/master/screenshot/Lark20201019105512.png)

生成LeetCode题解项目，需要基于一个 LeetCode 爬虫项目生成的 result.json 文件
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222213.png)

媒体资源管理，文章的图片也会上传存储到这里
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222226.png)

站点顶部菜单配置，包含名称、顺序、打开方式等
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222239.png)

网站其它配置，如个人信息、关于页面数据等
![](https://raw.githubusercontent.com/techflowing/Blog/master/screenshot/Lark20201011222256.png)

## 部署说明
### 环境准备
安装 PHP 7.3、MySQL、Nginx、Composer、npm、Bower
> 需要PHP 7.3，7.4 版本 laraval-admin 验证码生成有点问题

### 部署步骤

clone 项目
> git clone https://github.com/Witcier/blog.git

编辑配置（备份、阿里云OSS、备案等信息按需配置，非必须）
> cp .env.example .env

安装依赖
> composer install

生成Key
> php artisan key:generate

配置默认数据
> php artisan migrate:refresh --seed

生成静态资源
> npm install

> npm run dev

生成思维导图相关资源 [Kity Minder](https://github.com/fex-team/kityminder "Kity Minder")
> bower install

测试
> php artisan serve

测试访问地址：http://127.0.0.1:8000  ，
后台管理地址：http://127.0.0.1:8000/admin ，默认账户：admin，默认密码：admin

测试没问题后，配置 Nginx，根目录指向 public 文件夹

### 其它说明

#### 定时备份
[Laravel 数据库及项目文件自动备份指北](https://learnku.com/articles/16185/laravel-database-and-project-code-automatic-backup-north-spatielaravel-backup "Laravel 数据库及项目文件自动备份指北")

[Laravel 定时任务](https://learnku.com/laravel/t/1402/laravel-timing-task "Laravel 定时任务")

Laravel-backu 已经在项目集成，只需要配置阿里云 OSS 后基于 Linux Crontab 执行定时任务即可，每日凌晨会自动备份相关资源到阿里云OSS

#### 留言板配置
留言板基于 valine 实现，需要在后台配置自己的 APPID 和 APPKEY

#### 常见问题

[Mysql 8.0 认证方式问题](https://www.cnblogs.com/cndavidwang/p/9357684.html "Mysql 8.0 认证方式问题")

##### 已知问题

1. 浏览器适配（当前仅适配 Chrome）
2. bower install 被执行时会出现个别扩展无法正常安装，建议手动一个个安装


## 致谢

##### 致谢

* [Laravel](https://learnku.com/laravel)
* [WebStack-Laravel](https://github.com/hui-ho/WebStack-Laravel "WebStack-Laravel")
* [Laravel-admin](https://laravel-admin.org/ "Laravel-admin")
* [Editor.md](http://editor.md.ipandao.com/ "Editor.md")
* [Layer ](https://layer.layui.com/ "Layer ")
* [zTree](http://www.treejs.cn/v3/main.php#_zTreeInfo "zTree")
* [SmartWiki](https://github.com/lifei6671/SmartWiki "SmartWiki")
* [Valine](https://valine.js.org/)
* [KityMinder](https://github.com/fex-team/kityminder)
* [Laravel Sail](https://learnku.com/docs/laravel/8.x/sail/9789)
* [Dcat Admin](https://learnku.com/docs/dcat-admin/2.x)
