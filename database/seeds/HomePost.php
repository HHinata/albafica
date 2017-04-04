<?php

use Illuminate\Database\Seeder;

class HomePost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Models\Post();
        $post->content = <<<CONTENT
<p>几个星期前，我一个朋友问我：“为什么要关心 Go 语言”？ 因为他们知道我热衷于 Go 语言，但他们想知道为什么我认为<span style="color: rgb(66, 150, 42);">其他人</span>也应该关心。本文包含三个我认为 Go 是重要的编程语言的原因。</p><h3>安全</h3><p>个人而言，你和我或许完全有能力在 C 中编写程序，既不会泄漏内存，也不会不安全地重复使用内存。然而，整体上，即使有超过&nbsp;<a href="https://en.wikipedia.org/wiki/C_(programming_language)" target="_blank" style="color: rgb(77, 138, 216);">40 年</a>的经验，用 C 的程序员也无法可靠地这样做。</p><p>尽管静态代码分析、valgrind、tsan 以及 “-Werror” 已经存在了几十年，却很少有证据表明这些工具被广泛认可，更不用说广泛采用。总而言之，事实表明，程序员根本无法安全地管理自己的内存。现在是离开 C 的时候了。</p><p>Go 不需要程序员直接管理内存，所有内存分配都由语言运行时自行管理，使用前初始化，必要时检查边界。它肯定不是提供这些安全保障的第一个主流语言，Java（1995）可能是该冠军的竞争者。关键是，世界对不安全的编程语言没有胃口，所以人们默认认为，Go 是内存安全的。</p><h3>开发人员生产力</h3><p>从 20 世纪 70 年代末，开发人员的时间变得比硬件所耗费的时间更昂贵了。开发人员的生产力是一个不断扩展的话题，但它归结为这一点：你花了多少时间做有用的工作，又有多少时间等待编译器或者失望地迷失在外部代码库中。</p><p>有个笑话说 Go 是在等待&nbsp;<a href="https://commandcenter.blogspot.com.au/2012/06/less-is-exponentially-more.html" target="_blank" style="color: rgb(77, 138, 216);">C ++ 程序编译</a>时开发的。快速编译是 Go 的一个重要功能，也是吸引新开发人员的关键工具。虽然编译速度仍然是一个<a href="https://dave.cheney.net/2016/11/19/go-1-8-toolchain-improvements" target="_blank" style="color: rgb(77, 138, 216);">永久的战场</a>，但公平地说，在其他语言中需要几分钟的编译，在 Go 中只需要几秒钟。</p><p>Go 程序员意识到生产力的更根本的问题是代码是<span style="color: rgb(196, 15, 15);">为了读而写的</span>，所以将<a href="https://twitter.com/rob_pike/status/791326139012620288" target="_blank" style="color: rgb(77, 138, 216);">代码的阅读行为放在编写之上</a>。Go 通过工具和自定义来强制所有代码格式化成特定的样式。这消除了学习项目特定语言的方言时的困难，并有助于发现错误，因为它们<span style="color: rgb(196, 15, 15);">看上去</span>就是不正确。</p><p>由于专注于分析和机器辅助，Go 开发人员开始采用越来越多的工具来发现常见的编码错误，这种工具从来没有在 C 语言开发者中产生共鸣 - Go 开发人员<span style="color: rgb(196, 15, 15);">希望</span>工具帮助他们保持代码清洁。</p><h3>并发性</h3><p>十多年来，芯片设计师一直在警告<a href="http://www.gotw.ca/publications/concurrency-ddj.htm" target="_blank" style="color: rgb(77, 138, 216);">免费午餐将会结束</a>。从最低端的手机到最耗电的服务器，硬件的并行性以<a href="https://www.technologyreview.com/s/601441/moores-law-is-dead-now-what/" target="_blank" style="color: rgb(77, 138, 216);">更多、更慢、堆砌 cpu 内核</a>的形式出现，但只有<span style="color: rgb(196, 15, 15);">当</span>你的语言可以利用它们才有意义。因此，并发特性需要内置到我们编写的要在今天的硬件上运行的软件中。</p><p>通过提供一种基于协程的<a href="https://blog.golang.org/concurrency-is-not-parallelism" target="_blank" style="color: rgb(77, 138, 216);">轻量级并发模型</a>，或者是 Go 中已知的 goroutines，Go 超越了那些暴露操作系统的多进程或多线程并行模型的语言。goroutines 允许程序员避开复杂的回调，而语言运行时确保有足够的线程来保持你的内核的活跃。</p><h3>总结</h3><p>我给朋友推荐 Go 有三个原因：安全性、生产力和并发性。有些语言可以涵盖一个也有可能是两个方面，但是这三个方面的结合使得 Go 成为主流程序员的绝佳选择。</p>
CONTENT;
        $post->title = '为什么使用 Go 语言？';
        $post->user_id = 1;
        $post->private = 0;
        $post->save();
        $notice = new \App\Models\Notice();
        $notice->post_id = $post->id;
        $notice->publish_time = 0;
        $notice->save();
    }
}
