Upgrade
#######

.. highlight:: php

1.x to 2.0
==========

Camel case params were removed from builder methods::

    <?php

    // was
    \Arokettu\Json\EncodeOptions::build(prettyPrint: true);
    // now
    \Arokettu\Json\EncodeOptions::build(pretty_print: true);
