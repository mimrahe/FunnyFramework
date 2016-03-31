<?php

/* create.html */
class __TwigTemplate_21a3434af65773a4209852422db0777c6aa131924d2e2eef40d8cf42837c27bb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<title>Create Link</title>
</head>
<body>
<h4>Create Link</h4>
<p>
\t<ul>
\t";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["info"]) ? $context["info"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 11
            echo "\t\t<li>";
            echo twig_escape_filter($this->env, $context["item"], "html", null, true);
            echo "</li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "\t</ul>
</p>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "create.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 13,  34 => 11,  30 => 10,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/* 	<title>Create Link</title>*/
/* </head>*/
/* <body>*/
/* <h4>Create Link</h4>*/
/* <p>*/
/* 	<ul>*/
/* 	{% for item in info %}*/
/* 		<li>{{ item }}</li>*/
/* 	{% endfor %}*/
/* 	</ul>*/
/* </p>*/
/* </body>*/
/* </html>*/
