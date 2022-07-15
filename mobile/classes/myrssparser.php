<?PHP
  # Original PHP code by Chirp Internet: www.chirp.com.au
  # Please acknowledge use of this code by including this header.

  class myRSSParser
  {
    # keeps track of current and preceding elements
    var $tags = array();

    # array containing all feed data
    var $output = array();

    # return value for display functions
    var $retval = "";

    # constructor for new object
    function myRSSParser($date)
    {
      # instantiate xml-parser and assign event handlers
      $xml_parser = xml_parser_create("");
      xml_set_object($xml_parser, $this);
      xml_set_element_handler($xml_parser, "startElement", "endElement");
      xml_set_character_data_handler($xml_parser, "parseData");

      # open file for reading and send data to xml-parser
      //$fp = @fopen($file, "r") or die("myRSSParser: Could not open $file for input");
      //while($data = fread($fp, 4096)) {
        xml_parse($xml_parser, $data) or die(
          sprintf("myRSSParser: Error <b>%s</b> at line <b>%d</b><br>",
          xml_error_string(xml_get_error_code($xml_parser)),
          xml_get_current_line_number($xml_parser))
        );
      //}
      //fclose($fp);

      # dismiss xml parser
      xml_parser_free($xml_parser);
    }

    function startElement($parser, $tagname, $attrs=array())
    {
      # RSS 2.0 - ENCLOSURE
      if($tagname == "ENCLOSURE" && $attrs) {
        $this->startElement($parser, "ENCLOSURE");
        foreach($attrs as $attr => $attrval) {
          $this->startElement($parser, $attr);
          $this->parseData($parser, $attrval);
          $this->endElement($parser, $attr);
        }
        $this->endElement($parser, "ENCLOSURE");
      }

      # check if this element can contain others - list may be edited
      if(preg_match("/^(RDF|RSS|CHANNEL|IMAGE|ITEM)/", $tagname)) {
        if($this->tags) {
          $depth = count($this->tags);
          list($parent, $num) = each($tmp = end($this->tags));
          if($parent) $this->tags[$depth-1][$parent][$tagname]++;
        }
        array_push($this->tags, array($tagname => array()));
      } else {
        if(!preg_match("/^(A|B|I)$/", $tagname)) {
          # add tag to tags array
          array_push($this->tags, $tagname);
        }
      }
    }

    function endElement($parser, $tagname)
    {
      if(!preg_match("/^(A|B|I)$/", $tagname)) {
        # remove tag from tags array
        array_pop($this->tags);
      }
    }

    function parseData($parser, $data)
    {
      # return if data contains no text
      if(!trim($data)) return;
      $evalcode = "\$this->output";
      foreach($this->tags as $tag) {
        if(is_array($tag)) {
          list($tagname, $indexes) = each($tag);
          $evalcode .= "[\"$tagname\"]";
          if(${$tagname}) $evalcode .= "[" . (${$tagname} - 1) . "]";
          if($indexes) extract($indexes);
        } else {
          if(preg_match("/^([A-Z]+):([A-Z]+)$/", $tag, $matches)) {
            $evalcode .= "[\"$matches[1]\"][\"$matches[2]\"]";
          } else {
            $evalcode .= "[\"$tag\"]";
          }
        }
      }
      eval("$evalcode = $evalcode . '" . addslashes($data) . "';");
    }

    # display a single channel as HTML
    function display_channel($data, $limit)
    {
      extract($data);
      if($IMAGE) {
        # display channel image(s)
        foreach($IMAGE as $image) $this->display_image($image);
      }
      if($TITLE) {
        # display channel information
        $this->retval .= "<h1>";
        if($LINK) $this->retval .= "<a href=\"$LINK\" target=\"_blank\">";
        $this->retval .= stripslashes($TITLE);
        if($LINK) $this->retval .= "</a>";
        $this->retval .= "</h1>\n";
        if($DESCRIPTION) $this->retval .= "<p>$DESCRIPTION</p>\n\n";
        $tmp = array();
        if($PUBDATE) $tmp[] = "<small>Published: $PUBDATE</small>";
        if($COPYRIGHT) $tmp[] = "<small>Copyright: $COPYRIGHT</small>";
        if($tmp) $this->retval .= "<p>" . implode("<br>\n", $tmp) . "</p>\n\n";
        $this->retval .= "<div class=\"divider\"><!-- --></div>\n\n";
      }
      if($ITEM) {
        # display channel item(s)
        foreach($ITEM as $item) {
          $this->display_item($item, "CHANNEL");
          if(is_int($limit) && --$limit <= 0) break;
        }
      }
    }

    # display a single image as HTML
    function display_image($data, $parent="")
    {
      extract($data);
      if(!$URL) return;

      $this->retval .= "<p>";
      if($LINK) $this->retval .= "<a href=\"$LINK\" target=\"_blank\">";
      $this->retval .= "<img src=\"$URL\"";
      if($WIDTH && $HEIGHT) $this->retval .= " width=\"$WIDTH\" height=\"$HEIGHT\"";
      $this->retval .= " border=\"0\" alt=\"$TITLE\">";
      if($LINK) $this->retval .= "</a>";
      $this->retval .= "</p>\n\n";
    }

    # display a single item as HTML
    function display_item($data, $parent)
    {
      extract($data);
      if(!$TITLE) return;

      $this->retval .=  "<p><b>";
      if($LINK) $this->retval .=  "<a href=\"$LINK\" target=\"_blank\">";
      $this->retval .= stripslashes($TITLE);
      if($LINK) $this->retval .= "</a>";
      $this->retval .=  "</b>";
      if(!$PUBDATE && $DC["DATE"]) $PUBDATE = $DC["DATE"];
      if($PUBDATE) $this->retval .= " <small>($PUBDATE)</small>";
      $this->retval .=  "</p>\n";

      # use feed-formatted HTML if provided
      if($CONTENT["ENCODED"]) {
        $this->retval .= "<p>" . stripslashes($CONTENT["ENCODED"]) . "</p>\n";
      } elseif($DESCRIPTION) {
        $this->retval .=  "<p>" . stripslashes($DESCRIPTION) . "</p>\n\n";
      }

      # RSS 2.0 - ENCLOSURE
      if($ENCLOSURE) {
        $this->retval .= "<p><small><b>Media:</b> <a href=\"{$ENCLOSURE['URL']}\">";
        $this->retval .= $ENCLOSURE['TYPE'];
        $this->retval .= "</a> ({$ENCLOSURE['LENGTH']} bytes)</small></p>\n\n";
      }

      if($COMMENTS) {
        $this->retval .= "<p style=\"text-align: right;\"><small>";
        $this->retval .= "<a href=\"$COMMENTS\">Comments</a>";
        $this->retval .= "</small></p>\n\n";
      }
    }

    function fixEncoding($input, $output_encoding)
    {
      $encoding = mb_detect_encoding($input);
      switch($encoding) {
        case 'ASCII':
        case $output_encoding:
          return $input;
        case '':
          return mb_convert_encoding($input, $output_encoding);
        default:
          return mb_convert_encoding($input, $output_encoding, $encoding);
      }
    }

    # display entire feed as HTML
    function getOutput($limit=false, $output_encoding='UTF-8')
    {
      $this->retval = "";
      $start_tag = key($this->output);

      switch($start_tag) {
        case "RSS":
          # new format - channel contains all
          foreach($this->output[$start_tag]["CHANNEL"] as $channel) {
            $this->display_channel($channel, $limit);
          }
          break;

        case "RDF:RDF":
          # old format - channel and items are separate
          foreach($this->output[$start_tag]["CHANNEL"] as $channel) {
            $this->display_channel($channel, $limit);
          }
          foreach($this->output[$start_tag]["ITEM"] as $item) {
            $this->display_item($item, $start_tag);
          }
          break;

        case "HTML":
          die("Error: cannot parse HTML document as RSS");

        default:
          die("Error: unrecognized start tag '$start_tag' in getOutput()");
      }

      return $this->fixEncoding($this->retval, $output_encoding);
    }

    # return raw data as array
    function getRawOutput($output_encoding='UTF-8')
    {
      return $this->fixEncoding($this->output, $output_encoding);
    }
  }
?>
