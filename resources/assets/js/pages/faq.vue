<template>
    <div>
        <h1 style="color:#1a5cc8" align="center">Frequently Asked Questions</h1><div class="panel_title" align="left"></div><div class="panel_content">
        <div class="question">Q <a name="q1"></a>What does "HDOJ" stand for ?</div>
        <div class="answer">A <b><i>HDOJ</i></b> is short for Hangzhou Dianzi University Online Judge which was founded in September 2005 and has the lastest version of 3.0.</div>



        <div class="question">Q <a name="q2"></a>Which programming languages can I use at Online Judge ?</div>
        <div class="answer">A <b><i>C</i></b>, <b><i>C++</i></b>, <b><i>Pascal</i></b> and <b><i>Java</i></b> are currently supported at Online Judge.</div>



        <div class="question">Q <a name="q3"></a>How to write a solution using my favourite programming language ?</div>
        <div class="answer">A You can find the answer in corresponding section:<br>
            <ul>
                <li><a href="/faq.php?topic=java">How to write Java solutions</a><br></li>
                <li><a href="/faq.php?topic=cpp">How to write C/C++ solutions</a><br></li>
                <li><a href="/faq.php?topic=pascal">How to write Pascal solutions</a></li>
            </ul>
        </div>



        <div class="question">Q <a name="q4"></a>Is there any way to determine if my program is runned at Online Judge or not ?</div>
        <div class="answer">A There is a conditional define of compiler called <b>ONLINE_JUDGE</b>. Example of using:<br><br>
            <b><i>C/C++</i></b>
            <pre id="code">#ifdef ONLINE_JUDGE
    running on online judge
#endif
</pre>
            <b><i>Pascal</i></b>
            <pre id="code">{$IFDEF ONLINE_JUDGE}
    running on online judge
{$ENDIF}
</pre>
        </div>



        <div class="question">Q <a name="q5"></a>What kind of input and output can I use at Online Judge ?</div>
        <div class="answer">A Only <b><i>stdin</i></b> (standard input) and <b><i>stdout</i></b> (standard output) can be used. For instance, you can use <b><i>scanf</i></b> in <b><i>C</i></b> or <b><i>cin</i></b> in <b><i>C++</i></b> to read, and <b><i>printf</i></b> in <b><i>C</i></b> or <b><i>cout</i></b> in <b><i>C++</i></b> to write. Your programs are <b>NOT</b> allowed to open and read from / write to files. You will probably get a <font color="green"><b>Runtime Error</b></font> or <font color="green"><b>Wrong Answer</b></font> if you try to do so.<br>Besides, you should note that, in most cases, <b><i>C runtime I/O functions are more effective than those of C++'s</i></b>, so <b><i>scanf</i></b> and <b><i>printf</i></b> is recommended to process huge input or output.
        </div>



        <div class="question">Q <a name="q6"></a>What are the meanings of the judge's replies</div>
        <div class="answer">A Here is a list of the Judge's replies and their meaning:<br><br>
            <ul>
                <li><font color="green"><b>Queuing</b></font>: The judge is so busy that it can't judge your solution at the moment. Usually you just need to wait a while because our judge server is powered by IBM and Intel Xeon :-)</li>
                <li><font color="green"><b>Compiling</b></font> : Your solution is being compiled to binary form by specified compiler.</li>
                <li><font color="green"><b>Running</b></font> : Your program is running on the server and fed with input data if necessary.</li>
                <li><font color="red"><b>Accepted (AC)</b></font> : Yes, your program is correct. You did a good job!</li>
                <li><font color="orange"><b>Presentation Error (PE)</b></font> : Your program's output format is not exactly the same as required by the problem, although the output is correct. This usually means the existence of omitted or extra blank characters (white spaces, tab characters and/or new line characters) between any two non-blank characters, and/or blank lines (a line consisting of only blank characters) between any two non-blank lines. Trailing blank characters at the end of each line and trailing blank lines at the of output are not considered format errors. Check the output for spaces, blank lines, etc. against the problem's output specification.</li>
                <li><font color="green"><b>Wrong Answer (WA)</b></font> : Correct solution not reached for the inputs. The inputs and outputs that we use to test the programs are not public (it is recomendable to get accustomed to a true contest dynamic :-)</li>
                <li><font color="green"><b>Runtime Error (RE)</b></font> : Your program failed during the execution and you will receive the hints for the reasons. Here are part of the hints and their meanings.
                    <ul>
                        <li><font color="green"><b><i>ACCESS_VIOLATION</i></b></font> Your program tried to read from or write to a address for which it does not have the appropriate access.</li>
                        <li><font color="green"><b><i>ARRAY_BOUNDS_EXCEEDED</i></b></font> Your program tried to access an array element that is out of bounds and the underlying hardware supports bounds checking.</li>
                        <li><font color="green"><b><i>FLOAT_DENORMAL_OPERAND</i></b></font> One of the operands in a floating-point operation is denormal. A denormal value is one that is too small to represent as a standard floating-point value.</li>
                        <li><font color="green"><b><i>FLOAT_DIVIDE_BY_ZERO</i></b></font> The thread tried to divide a floating-point value by a floating-point divisor of zero.</li>
                        <li><font color="green"><b><i>FLOAT_OVERFLOW</i></b></font> The exponent of a floating-point operation is greater than the magnitude allowed by the corresponding type.</li>
                        <li><font color="green"><b><i>FLOAT_UNDERFLOW</i></b></font> The exponent of a floating-point operation is less than the magnitude allowed by the corresponding type.</li>
                        <li><font color="green"><b><i>INTEGER_DIVIDE_BY_ZERO</i></b></font> Your program tried to divide an integer value by an integer divisor of zero.</li>
                        <li><font color="green"><b><i>INTEGER_OVERFLOW</i></b></font> The result of an integer operation caused a carry out of the most significant bit of the result.</li>
                        <li><font color="green"><b><i>STACK_OVERFLOW</i></b></font> Your program used up its stack.</li>
                        <li><font color="green"><b><i>......</i></b></font> Other runtime errors.</li>
                    </ul>
                </li>
                <li><font color="green"><b>Time Limit Exceeded (TLE)</b></font> : Your program tried to run during too much time.</li>
                <li><font color="green"><b>Memory Limit Exceeded (MLE)</b></font> : Your program tried to use more memory than the judge default settings.</li>
                <li><font color="green"><b>Output Limit Exceeded (OLE)</b></font> : Your program tried to write too much information. This usually occurs if it goes into a infinite loop.</li>
                <li><font color="green"><b>Compilation Error (CE)</b></font> : The compiler fails to compile your program. Warning messages are not considered errors. Click on the judge's reply to see the warning and error messages produced by the compiler.</li>
                <li><font color="green"><b>System Error</b></font>: The judge cannot run your program. One example is that your program requires much more memory than hardware limitation.</li>
                <li><font color="green"><b>Out Of Contest Time</b></font> : This message can only appear during a contest, if a program is submitted out of contest time.</li>
            </ul>
        </div>



        <div class="question">Q <a name="q7"></a>What does "<font color="red">Special Judge</font>" mean ?</div>
        <div class="answer">A When a problem has multiple acceptable answers, a <b>special judge</b> program is needed. The special judge program uses the input data and some other information to check your program's output and returns the result to the judge.</div>



        <div class="question">Q <a name="q8"></a>My program got an <font color="red">AC</font> in C++ while <font color="green">TLE</font> in G++ !</div>
        <div class="answer">A This mostly occurs in the case that your program have to process huge input. As we known, MS-VC++ is more effective to process I/O althrough we have tried our best to reduce the difference. This can hardly occur because we have tested most of the test cases in both C++ and G++ before we publish a problem on condition that you solve the problem with correct algorithms.</div>



        <div class="question">Q <a name="q9"></a>I'm sure that my program is incorrect but I still got an <font color="red">AC</font> !</div>
        <div class="answer">A Maybe our test cases are not strong enough to catch the bugs in your program. Please let us know.</div>



        <div class="question">Q <a name="q10"></a><font color="red">How can I participate in online contests ?</font></div>
        <div class="answer">A There are two kinds of online contests at HDOJ. One is <font color="red"><b>public</b></font> and the other is <font color="green"><b>private</b></font>. Everyone who has an account of HDOJ can participate in a public contest, but only specified ones who had been invited to the contests can take part in a private one.<br>
            To participate in the public contests, you should register an account first if you don't own one, then use your account and password to log in the contest.<br>
            To participate private ones, your should use the id and password supplied by the organizer for login.
        </div>



        <div class="question">Q <a name="q11"></a><font color="red">Can I arrange a contest at HDOJ ?</font></div>
        <div class="answer">A If you want to arrange a programming contest, and you don't have enough equipments or time to setup an automated judge, HDOJ will be pleased to host the contest for you.<br>
            What you need to setup your own contest are:
            <ul>
                <li>A problem set with test cases.</li>
                <li>The list of the teams who will participate in the Contest. This can be omitted if the contest is a public one but necessary for a private one.</li>
                <li>The date for the contest (GMT+8).</li>
            </ul>
            Send the stuff above to <a href="mailto:739609084@qq.com">739609084@qq.com</a> by email and wait for our reply. If your apply is accepted, your contest will be arranged in HDOJ's contests schedule.
        </div>



        <div class="question">Q <a name="q13"></a>How to use 64-bit integer types ?</div>
        <div class="answer">A Server supports signed and unsigned 64-bit integers.
            <ul>
                <li>
                    Signed 64-bit integer. Value range: -9223372036854775808 .. 9223372036854775807.
                    <table align="center" border="1" bordercolor="#B7CBFF">
                        <tbody><tr align="center">
                            <td>Language</td>
                            <td>GCC/G++</td>
                            <td>Pascal</td>
                            <td>C/C++</td>
                        </tr>
                        <tr align="center">
                            <td>Type name</td>
                            <td>__int64<br>
                                or<br>
                                long long
                            </td>
                            <td>int64</td>
                            <td>__int64</td>
                        </tr>
                        <tr align="center">
                            <td>Input</td>
                            <td>scanf("%I64d", &amp;x);<br>
                                or<br>
                                cin &gt;&gt; x;
                            </td>
                            <td>read(x);</td>
                            <td>scanf("%I64d", &amp;x);</td>
                        </tr>
                        <tr align="center">
                            <td>Output</td>
                            <td>printf("%I64d", x);</td>
                            <td>cout &lt;&lt; x; write(x);</td>
                            <td>printf("%I64d", x);</td>
                        </tr>
                        </tbody></table>
                </li>
                <li>
                    Unsigned 64-bit integer. Value range: 0 .. 18446744073709551615.

                    <table align="center" border="1" bordercolor="#B7CBFF">
                        <tbody><tr align="center">
                            <td>Language</td>
                            <td>GCC/G++</td>
                            <td>Pascal</td>
                            <td>C/C++</td>
                        </tr>
                        <tr>
                            <td>Type name</td>
                            <td>unsigned __int64<br>
                                or<br>
                                unsigned long long<br>
                            </td>
                            <td>qword</td>
                            <td>unsigned __int64</td>
                        </tr>
                        <tr>
                            <td>Input</td>
                            <td>scanf("%I64u", &amp;x);<br>
                                or<br>
                                cin &gt;&gt; x;
                            </td>
                            <td>read(x);</td>
                            <td>scanf("%I64u", &amp;x);</td>
                        </tr>
                        <tr>
                            <td>Output</td>
                            <td>printf("%I64u", x);<br>
                                or
                                cout &lt;&lt; x;
                            </td>
                            <td>write(x);</td>
                            <td>printf("%I64u", x);</td>
                        </tr>
                        </tbody></table>
                </li>
            </ul>
        </div>



        <div class="question">Q <a name="q14"></a>How can I read input data until the end of file ?</div>
        <div class="answer">A You can do it for example like this:
            <table align="center" border="1" bordercolor="#B7CBFF">
                <tbody><tr>
                    <td>Language</td>
                    <td>C</td>
                    <td>C++</td>
                    <td>Pascal</td>
                </tr>
                <tr>
                    <td>To read numbers</td>
                    <td>int n;<br>
                        while(scanf("%d", &amp;n) != EOF)<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>int n;<br>
                        while (cin &gt;&gt; n)<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>var n: integer;<br>
                        ...<br>
                        while not seekeof   do<br>
                        begin<br>
                        　　read(n);<br>
                        　　...<br>
                        end;<br>
                    </td>
                </tr>
                <tr>
                    <td>To read characters</td>
                    <td>int c;<br>
                        while ((c = getchar()) !=   EOF)<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>char c;<br>
                        while (cin.get(c))<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>var c: char;<br>
                        ...<br>
                        while not eof   do<br>
                        begin<br>
                        　　read(c);
                        <br>
                        　　...<br>
                        end;<br>
                    </td>
                </tr>
                <tr>
                    <td>To read lines</td>
                    <td>char line[1024];<br>
                        while(gets(line))<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>string line;<br>
                        while (getline(cin, line))<br>
                        {<br>
                        　　...<br>
                        }<br>
                    </td>
                    <td>var line: string;<br>
                        ...<br>
                        while not eof do<br>
                        begin<br>
                        　　readln(line);<br>
                        　　...<br>
                        end;<br>
                    </td>
                </tr>
                </tbody></table>
        </div>



        <div class="question">Q <a name="q15"></a>What is the maximal size of program that can be submitted ?</div>
        <div class="answer">A The maximal size of program is 65535 characters.</div>
        <br><center><font color="gray" size="-1">This page was generated by web cache at 2010-08-08 10:49:48</font></center></div><div class="panel_bottom">&nbsp;</div>	<br>
    </div>
</template>