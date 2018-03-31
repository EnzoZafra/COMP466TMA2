DROP DATABASE IF EXISTS ecourse;

CREATE DATABASE ecourse;

USE ecourse;

CREATE TABLE IF NOT EXISTS `users` (
	  `userid` INT NOT NULL AUTO_INCREMENT,
	  `username` VARCHAR(45) NOT NULL,
	  `password` VARCHAR(45) NOT NULL,
	  PRIMARY KEY (`userid`),
	  UNIQUE INDEX `username_UNIQUE` (`username` ASC));

CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` INT NOT NULL AUTO_INCREMENT,
  `coursename` VARCHAR(300) NOT NULL,
  `description` TEXT,
  PRIMARY KEY (`courseid`));

CREATE TABLE IF NOT EXISTS `users_has_courses` (
  `users_userid` INT NOT NULL,
  `courses_courseid` INT NOT NULL,
  PRIMARY KEY (`users_userid`, `courses_courseid`),
  INDEX `fk_users_has_courses_courses1_idx` (`courses_courseid` ASC),
  INDEX `fk_users_has_courses_users_idx` (`users_userid` ASC),
  CONSTRAINT `fk_users_has_courses_users`
    FOREIGN KEY (`users_userid`)
    REFERENCES `users` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_courses1`
    FOREIGN KEY (`courses_courseid`)
    REFERENCES `courses` (`courseid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `units` (
  `unitid` INT NOT NULL AUTO_INCREMENT,
  `unitname` VARCHAR(200) NOT NULL,
  `courses_courseid` INT NOT NULL,
  PRIMARY KEY (`unitid`, `courses_courseid`),
  INDEX `fk_units_courses1_idx` (`courses_courseid` ASC),
  CONSTRAINT `fk_units_courses1`
    FOREIGN KEY (`courses_courseid`)
    REFERENCES `courses` (`courseid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `topics` (
  `topicid` INT NOT NULL AUTO_INCREMENT,
  `units_unitid` INT NOT NULL,
  `content` TEXT NULL,
  `topicname` VARCHAR(200) NULL,
  PRIMARY KEY (`topicid`, `units_unitid`),
  INDEX `fk_topics_units1_idx` (`units_unitid` ASC),
  CONSTRAINT `fk_topics_units1`
    FOREIGN KEY (`units_unitid`)
    REFERENCES `units` (`unitid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quizid` INT NOT NULL AUTO_INCREMENT,
  `units_unitid` INT NOT NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`quizid`, `units_unitid`),
  INDEX `fk_quizzes_units1_idx` (`units_unitid` ASC),
  CONSTRAINT `fk_quizzes_units1`
    FOREIGN KEY (`units_unitid`)
    REFERENCES `units` (`unitid`)
    ON DELETE NO ACTION
	ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `media` (
  `mediaid` INT NOT NULL AUTO_INCREMENT,
  `medianame` VARCHAR(100) NULL,
  `content` BLOB NULL,
  `topics_topicid` INT NOT NULL,
  PRIMARY KEY (`mediaid`, `topics_topicid`),
  INDEX `fk_media_topics1_idx` (`topics_topicid` ASC),
  CONSTRAINT `fk_media_topics1`
    FOREIGN KEY (`topics_topicid`)
    REFERENCES `topics` (`topicid`)
    ON DELETE NO ACTION
	ON UPDATE NO ACTION);

INSERT INTO `courses`
(`coursename`, `description`)
VALUES
('COMP 466 - Advanced Technologies for Web-Based Systems',
'Computer Science 466: Advanced Technologies for Web-Based Systems extends the student\'s knowledge and skills in computing, network programming, web design, and system development.');

INSERT INTO `units`
(`unitname`,
`courses_courseid`)
VALUES
('Unit 1 - Web, HTML5 and CSS', '1'), ('Unit 2 - JavaScript', '1'), ('Unit 3 - XML and Ajax', '1');

INSERT INTO `topics`
(`units_unitid`,
`content`,
`topicname`)
VALUES
('1','<subtopic>
  <header>1.1.0 Web History</header>
  <data>Moore\'s Law is a trend that states: Every year or two, the capacities of computers have doubled inexpensively</data>
  <data>Computers and the Internet are being used in industry, research, health care, social good, communication, entertainment and more...</data>
  <data>A bit is the smallest data item in a computer; it can have the value of 0 or 1</data>
  <data>ARPANET allowed multiple users to send and receive information simultaneously over the same communication path</data>
  <data>The ARPANET network operated with a technique called packet switching, where data was sent in small bundles called packets</data>
  <data>The TCP/IP protocol for communicating over the ARPANET became known as Transmission Control Protocol (TCP)</data>
  <data>In October 1994, the World Wide Web Consortium (W3C) organization was founded.</data>
  <data>One of W3C\'s primary goals is to make the web universally accessible - regardless of disability, language or culture</data>
  <data>Technologies standardized by W3C are called Recommendations</data>
  <data>Current recommendations include HTML5, CSS and XML</data>
</subtopic>

<subtopic>
  <header>1.1.1 Web Servers</header>
  <data>A web page is nothing more than an HTML document. When the user tries to access a website, a web server locates the requested html file and sends it to the user\'s browser</data>
  <data>HTML documents contain hyperlinks, which when clicked, loads a specified web document</data>
  <data>Hyperlinks can also reference e-mail addresses by addressing mailto:emailAddress instead of a webpage URL</data>
  <data>URIs (Uniform Resource Identifiers) identify resources on the internet</data>
  <data>URIs that start with http:// are called URLs (Uniform Resource Locators)</data>
  <data>URL contains information that directs a browser to the resource that the user wishes to access</data>
  <data>When accessing a URL, a web browser sends an HTTP request to the server.</data>
  <data>The word GET is an HTTP method indicating that the client wishes to obtain a resource from the server</data>
  <data>Browsers often cache recently viewed web pages for quick reloading</data>
  <data>If there is no difference between the version of the web page in the cache vs. the version in the web server, your browsing experience is sped up</data>
  <data>The two most common HTTP request types are GET and POST</data>
  <data>A post request typically posts (or sends) data to the server</data>
  <data>To request documents from web servers, users must know the hostnames on which the web server resides</data>
  <data>Users can request documents from a local server or a remote server</data>
  <data>Local web servers can be accessed through your computer\'s name or through \'localhost\' which translates to IP Address: 127.0.0.1</data>
  <data>The Apache HTTP Server is currently the most popular web server</data>
  <data>To access an html file called \'example.html\' in directory \'chapter/figure/\' in the local server, you must access the URL of the form: \'http://localhost/example.html\'</data>
</subtopic>','Web'),
('1','<subtopic>
  <header>1.2.0 General Information</header>
  <data>HTML5 is a special type of computer language called a markup language</data>
  <data>It\'s designed to specify the content and structure of web pages in a portable manner</data>
  <data>HTML enables developers to create content that will render across a range of devices such as phones, computers, and tablets</data>
  <data>The document type declaration (DOCTYPE) is required in HTML5 documents so that browsers render the page in standard mode</data>
  <data>Comments in HTML5 start with &lt;!-- and end with --&gt; </data>
  <data>The html element encloses the head section and the body section</data>
  <data>The head section contains information about the HTML5 document, such as character set or the title of the page</data>
  <data>The body section contains the page\'s content, which the browser displays when the user visits the page</data>
  <data>HTML5 documents delimit most elements with a start tag (&lt;html&gt;) and end tag (&lt;/html&gt;)</data>
  <data>Start tags may have attributes that provide additional information about the element. Each attribute has a name and value seperated by an equals sign (=)</data>
</subtopic>
<subtopic>
  <header>1.2.1 Elements</header>
  <data>Paragraph elements begin with &lt;p&gt; and end with &lt;/p&gt;</data>
  <data>HTML5 provides six heading elements (h1 through h6) for specifiying relative importance of information. h1 is most significant while h6 is the least</data>
  <data>The img element\'s src attribute specifies an image\'s location. Every image must have an alt attribute which contains text that is displayed if the client cannot render the image</data>
  <data>Void elements contain only attributes and do not mark up text. Void elements are terminated by using a forward slash character (/) inside the start tag</data>
  <data>Unordered lists begin with a &lt;ul&gt; and end with &lt;/ul&gt;</data>
  <data>Each entry in the list is an li element</data>
  <data>Ordered lists begin with a &lt;ol&gt; and end with &lt;/ol&gt;</data>
  <data>HTML5 provides forms for collecting information from users</data>
</subtopic>
<subtopic>
  <header>1.2.2 Forms</header>
  <data>Form elements have a method attribute which specifies how the form\'s data is sent to the web server</data>
  <data>The action attribute of the form specifies the script to which the form data will be sent</data>
  <data>HTML allows linking to another section of the same document by specifiying the element\'s id as the link\'s href</data>
</subtopic>', 'HTML5'),
('1','<subtopic>
  <header>1.3.0 General Information</header>
  <data>Cascading Style Sheets (CSS) are used to specify the presentation or styling of elements on a web page</data>
  <data>CSS was designed to style portable web pages independently of their content and structure</data>
  <data>CSS allows the developer to easily change the look of the website by swapping out style sheets for another</data>
  <data>Each CSS property is followed by a colon and the value of the attribute</data>
  <data>Styles that are placed in a style element use selectors to apply style elements throughout the entire document</data>
</subtopic>
<subtopic>
  <header>1.3.1 Embedded Style Sheets</header>
  <data>Embedded style sheets enable you to embed a CSS document in an HTML5 document\'s head section</data>
  <data>Styles that are placed in a style element use selectors to apply style elements throughout the document</data>
  <data>The style sheet\'s body declares the CSS rules for the style sheet</data>
  <data>Style-class declarations are preceded by a period (.)</data>
  <data>Style Classes define styles that can be applied to any element</data>
  <data>Properties such as the font, font-weight and font-size can be applied through style sheets. </data>
  <data>In many cases, styles applied to an elemnt also apply to the element\'s nested elements</data>
</subtopic>
<subtopic>
  <header>1.3.2 External Style Sheets</header>
  <data>External style sheets are seperate documents that contain only CSS rules</data>
  <data>When changes to the styles are required, you need to modify only a single CSS file. This concept is known as skinning</data>
  <data>The link html element is used to link external style sheets</data>
  <data>For example, the following style sheet will set the font-size, color and background-color of all elements in the HTML file\'s body section.
	body      { font-size : 20pt;
					color:  yellow;
					background-color: navy; }
  </data>
</subtopic>
<subtopic>
  <header>1.3.3 Backgrounds</header>
  <data>CSS can control the backgrounds of block-level elements by adding Colors and Images</data>
  <data>The background-image property specifies the URL of the image</data>
  <data>The background-position property places the image on the page using values such as: top, bottom, center, left and right</data>
</subtopic>', 'CSS');

INSERT INTO `topics`
(`units_unitid`,
`content`,
`topicname`)
VALUES
('2','<subtopic>
      <header>2.0.0 General Information</header>
      <data>The &lt;script&gt; tag indicates to the browser that the text which follows is part of a script</data>
      <data>Javascript is case sensitive</data>
      <data>Every statement should end with a semicolon, although none is required by JavaScript</data>
      <data>JS code is typically placed in a separate file then included in the HTML5 document that uses the script</data>
    </subtopic>
    <subtopic>
      <header>2.0.1 Language Specifics</header>
      <data>The keyword \'var\' is used to declare the names of variables</data>
      <data>A variable name can be any valid identifier consisting of alphanumeric characters, underscores and dollar signs</data>
      <data>The null keyword signifies that a variable has no value</data>
    </subtopic>
    <subtopic>
      <header>2.0.2 Control Statements</header>
      <data>A procedure for solving a problem in terms of actions and order of actions is called an algorithm</data>
      <data>A pseudo code is an informal language that helps you develop algorithms</data>
      <data>JavaScript provides three selection structures: if statement, if..else statement and switch statement</data>
      <data>JavaScript provides four repetition statements, while, do...while, for and for...in</data>
      <data>The conditional operator (?:) takes 3 operands.
        The first operand is the boolean expression,
        second is the value if the expression evaluates to true.
        The third is the value if the operation evaluates to false
      </data>
      <data>The for statement takes the initial value of the control variable, a loop-continuation variable, and an increment/decrement of control variable</data>
      <data>When working with for or while loops, be careful about non-terminating loops. Make sure that the loop-continuation variable is going to terminate at some point</data>
      <data>Break and continue statements are used to immediately exit or continue with the next statement in the sequence respectively</data>
    </subtopic>
    <subtopic>
      <header>2.0.3 Functions</header>
      <data>Javascript provides several objects that have a rich collection of methods for performing calculatons, string manipulations, date and time, and manipulations of collections of data called arrays</data>
      <data>The return statement passes information from a function back to the point in the program where it was called</data>
      <data>Three ways to return conrol: reaching function-ending right brace, executing the statement return;, executing the statement return expression;</data>
      <data>Each identifier in a program has a scope</data>
      <data>The scope for a variable or function is the portion of the program in which the identifier can be referenced</data>
      <data>Global variables or script-level variables are accessible in any part of a script</data>
      <data>Identifiers declared inside a function have a local scope and can be used only in that function</data>
      <data>If a local variable has the same name as a global variable, the global variable is \'hidden\' from the function since the local variable is referenced</data>
      <data>JavaScript provides nine global functions as part of a Global object. This object contains global variables, user-defined functions and built-in global functions</data>
      <data>A recursive function is a function that calls itself. It only knows how to solve a base case which then it returns a result</data>
      <data>For a recursive function to eventually terminate, each call must be a simpler version of the original problem and converge to the base case</data>
    </subtopic>
    <subtopic>
      <header>2.0.4 Arrays</header>
      <data>Arrays are created using a comma-separated initializer list enclosed in square brackets([])</data>
      <data>Initial values of an array can be specified as arguments in the parentheses following new Array</data>
      <data>There are two pays to pass arguments to functions: pass-by-value and pass-by-reference</data>
      <data>Pass-by-value takes a copy of the value and then passed to the function</data>
      <data>Pass-by-reference gives the called function access to the data and allows the function to modify the data</data>
      <data>Objects and arrays are passed by reference</data>
      <data>JavaScript offers methods for joining, sorting and searching Arrays</data>
    </subtopic>
    <subtopic>
      <header>2.0.5 Events</header>
      <data>Events allow scripts to respond to user interactions and modify the page accordingly</data>
      <data>An event handler is a function that responds to an event</data>
      <data>Method addEventListener can be called on a DOM node to register event-handling method for an event. This can be done multiple times</data>
      <data>It\'s also possible to remove an event listener by calling removeEventListener</data>
      <data>Typical events that are used are start, mouseMove, mouseover, mouseout, focus and blur</data>
      <data>Event bubbling is the process whereby events fired on child elements \'bubble\' up to their parent elements</data>
      <data>Both the child and then parents event handlers are called when the event is fired on a child element</data>
    </subtopic>
','JavaScript');

INSERT INTO `topics`
(`units_unitid`,
`content`,
`topicname`)
VALUES
('3','<subtopic>
      <header>3.0.0 General Information</header>
      <data>XML is a portable open technology for data storage and exchange</data>
      <data>XML allows authors to create markup for any time of information</data>
      <data>An XML parser is responsible for identifying components of XML documents and storing it inside a data structure</data>
    </subtopic>
    <subtopic>
      <header>3.0.1 Structuring Data</header>
      <data>XML documents contain elements like html elements</data>
      <data>XML is a tree like structure, where a parent can have multiple child elements</data>
      <data>The root element of an XML document encompasses all its other elements</data>
    </subtopic>
    <subtopic>
      <header>3.0.2 XML Schema Documents</header>
      <data>XML schemas specifies what type of data an element can contain</data>
      <data>XML schemas are used to verify the XML document</data>
      <data>Two categories of types exist in XML schema: simple types and complex types</data>
    </subtopic>
    <subtopic>
      <header>3.0.3 Extensible Stylesheet Language (XSL)</header>
      <data>XSL sheets converts XML into a text-based document</data>
      <data>XSL selectively navigates the source tree using XPath\'s select and match attributes</data>
      <data>XSL sheets are connected directly to an XML document by adding an instruction to the XML document</data>
      <data>Functions are given such as value-of and for-each to transform the XML element to a readable object</data>
    </subtopic>
    <subtopic>
      <header>3.0.4 Document Object Model</header>
      <data>Some XML parsers store document data as tree structures in memory</data>
      <data>This heirarchical structure is called a Document Object Model (DOM) tree</data>
      <data>Each element name is represented by a node</data>
      <data>A parent node can have many children but a child can only have one parent node</data>
      <data>A node has properties that allows the developer to grab information about the node such as : nodeName, childNodes, nodeValue and so on..</data>
      <data>The tree helps the developers traverse the XML document easily while obtaining properties of each node</data>
    </subtopic>
', 'XML'),
('3','<subtopic>
      <header>3.1.0 General Information</header>
      <data>Ajax applications separate client-side user interaction and server communication so that it can run them in parallel</data>
      <data>Raw Ajax uses JavaScript to send asynchronous requests to the server, then update the page using DOM</data>
      <data>The client creates an XMLHttpRequest object to manage a request and then sends it to the server</data>
      <data>The request object invokes a callback function that typically updates to display the returned data without reloading the entire page</data>
    </subtopic>
    <subtopic>
      <header>3.1.1 Exception Handling</header>
      <data>An exception is an indication that a problem has occured during program execution</data>
      <data>Exception handling enables you to create applications that can resolve the exceptions</data>
      <data>the try{} block encloses code that might cause an eception</data>
      <data>A catch{} block followed by an exception parameter handles an exception</data>
    </subtopic>
    <subtopic>
      <header>3.1.2 JSON</header>
      <data>JavaScript Object Notation is a way to represent objects as strings</data>
      <data>In a JSON file, objects are represented as a list of property names and their values</data>
      <data>JSONs contains arrays and strings</data>
      <data>Typically, Web Services respond to requests by sending JSON data to the requester</data>
    </subtopic>
', 'Ajax');

INSERT INTO `quizzes`
(`units_unitid`,
`content`)
VALUES
('1',
'  <question>
    <type>fill</type>
    <prompt>What law states that, for every year the capacities of computers have doubled efficiently</prompt>
    <answer>Moores</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>Which technologies are considered as Recommendations by W3C?</prompt>
    <choice>A: HTML</choice>
    <choice>B: CSS</choice>
    <choice>C: XML</choice>
    <choice>D: All of the above</choice>
    <answer>D</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>Hyperlinks only work when linking web page URLs</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>False</answer>
  </question>
  <question>
    <type>select</type>
    <prompt>Select all HTTP request types that are available</prompt>
    <choice>GET</choice>
    <choice>REQUEST</choice>
    <choice>POST</choice>
    <choice>REMOVE</choice>
    <choice>DELETE</choice>
    <answer>GET,POST,DELETE</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>All HTML elements must begin with start tag and end with an end tag</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>False</answer>
  </question>
  <question>
    <type>select</type>
    <prompt>Select all HTML elements that are available</prompt>
    <choice>h7</choice>
    <choice>b</choice>
    <choice>p</choice>
    <choice>ul</choice>
    <choice>ef</choice>
    <choice>h2</choice>
    <choice>h3</choice>
    <answer>b,p,ul,h2,h3</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>What does the abbreviation CSS stand for?</prompt>
    <choice>A: Controlling Style Selectors</choice>
    <choice>B: Callibrated Style Sheets</choice>
    <choice>C: Cascading Style Sheets</choice>
    <choice>D: Cascading Style Selectors</choice>
    <answer>C</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>Which properties can be applied through style sheets?</prompt>
    <choice>A: font</choice>
    <choice>B: font-weight</choice>
    <choice>C: font-size</choice>
    <choice>D: All of the Above</choice>
    <answer>D</answer>
  </question>
'),
('2',
'  <question>
    <type>mc</type>
    <prompt>Select the statement that is false</prompt>
    <choice>A: Javascript is a case sensitive language</choice>
    <choice>B: Every statement in javascript must end with a semicolon</choice>
    <choice>C: A variable name can consist of understores</choice>
    <choice>D: Javascript is typically placed in a separate file then included in the HTML document</choice>
    <answer>B</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>Pseudocode can be compiled an ran as an algorithm</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>False</answer>
  </question>
  <question>
    <type>fill</type>
    <prompt>What data structure is created by using a comma-separated initializer list?</prompt>
    <answer>Array</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>break statements are typically used to immediately exit out of a loop </prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>True</answer>
  </question>
  <question>
    <type>select</type>
    <prompt>Select all types of Control Statements from the list</prompt>
    <choice>if</choice>
    <choice>if...while</choice>
    <choice>while</choice>
    <choice>do...while</choice>
    <choice>for</choice>
    <choice>if...else</choice>
    <choice>var</choice>
    <choice>conditional</choice>
    <answer>if,while,do...while,for,if...else,conditional</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>Which method can be called to register event-handling on a DOM node?</prompt>
    <choice>A: addEventListener</choice>
    <choice>B: addEventHandler</choice>
    <choice>C: registerEventListener</choice>
    <choice>D: registerEventHandler</choice>
    <answer>A</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>Select the statement that is true about JavaScript</prompt>
    <choice>A: Global variables are accessible in any part of a script</choice>
    <choice>B: A recursive function is a function that calls itself and eventually terminates by solving the base case</choice>
    <choice>C: Each identifier in a program has a scope</choice>
    <choice>D: All of the Above</choice>
    <answer>D</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>Javascript objects and arrays are passed by value</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>True</answer>
  </question>
'
),
('3',
'  <question>
    <type>mc</type>
    <prompt>Which of the following statements is false?</prompt>
    <choice>A: Like humans, XML elements can have two parents</choice>
    <choice>B: XML\'s root element encompasses all of its other elements</choice>
    <choice>C: XSL sheets are connected to the XML documen by adding an instruction in the XML document</choice>
    <choice>D: Functions are provided to transform an XML element to a readable data form</choice>
    <answer>A</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>An Ajax request invokes a callback that is used to display data and partially update the user interface</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>True</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>What is JSON short for?</prompt>
    <choice>A: JavaScript Open Notation</choice>
    <choice>B: JavaScript Object Notation</choice>
    <choice>C: Josh Saget\'s Open Notation</choice>
    <choice>D: Josh Saget\'s Object Notation</choice>
    <answer>B</answer>
  </question>
  <question>
    <type>select</type>
    <prompt>Select all types that is supported by JSON</prompt>
    <choice>Integers</choice>
    <choice>Float</choice>
    <choice>Objects</choice>
    <choice>Strings</choice>
    <choice>Date</choice>
    <choice>Arrays</choice>
    <answer>Objects,Strings,Arrays</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>What object does a client need to create to create and send a request to a server?</prompt>
    <choice>A: XSLHttpRequest</choice>
    <choice>B: XSLHttpResponse</choice>
    <choice>C: XMLHttpRequest</choice>
    <choice>D: XMLHttpResponse</choice>
    <answer>C</answer>
  </question>
  <question>
    <type>tf</type>
    <prompt>XSL sheets are used to convert XML into a text-based document</prompt>
    <choice>True</choice>
    <choice>False</choice>
    <answer>True</answer>
  </question>
  <question>
    <type>mc</type>
    <prompt>Which of the following statements is True?</prompt>
    <choice>A: XML is a tree like structure. A parent can have multiple child elements</choice>
    <choice>B: XML is portable used for data storage and exchange</choice>
    <choice>C: XML parsers are used to identify components of XML documents</choice>
    <choice>D: All of the Above</choice>
    <answer>D</answer>
  </question>
  <question>
    <type>fill</type>
    <prompt>What is XML short for?</prompt>
    <answer>Extensible Markup Language</answer>
  </question>
'
)
;
