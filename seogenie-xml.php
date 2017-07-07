<?xml version="1.0" encoding="utf-8"?>
<plugin>
  <settings>
    <keywords value="remote" count="6">
      <title length="200" />
      <description length="300" />
    </keywords>
    <PluginActiveSites />
    <cache>
      <enabled value="False" />
      <maxPage value="500" />
      <delta percent="2" />
    </cache>
    <stopwords>
      <stopword><![CDATA[{]]></stopword>
      <stopword><![CDATA[-->]]></stopword>
    </stopwords>
    <features>
      <feature name="genImgAlt" include="*" exclude="*.htm*" />
    </features>
    <init>
      <startSession value="true" />
    </init>
    <analytics>
      <visitors decription="for user visits" include="bing|google|yahoo">
                        <![CDATA[<img id="SG_GOT_REQUEST_STATS" src="<<SG_CONTENT_SITE_URL>>submit/r.jpg?type=stats&req={<<SG_REFERAL_URL>>}" border="0" alt="" height="1" width="1"/>]]>
                    </visitors>
    </analytics>
  </settings>
  <operations version="1.0">
    <operation isEnabled="true">
      <if IsForAll="false">
        <condition multiline="true" validate="false"><![CDATA[<head\s*?[^<]*?\s*?/?>([\w\W]*?)</head]]></condition>
        <then>
          <if IsForAll="false">
            <condition multiline="true"><![CDATA[<meta[\s\W]+?[^<]*?[\s\W]*?name[\s\W]*?=[\s\W]*?["']description["'][\s\W]*[^<]*?[\s\W]*/?>]]></condition>
            <then>
              <if IsForAll="false">
                <condition multiline="true"><![CDATA[content[\s\W]*?=[\s\W]*?(["'])([\w\W]*?)\1]]></condition>
                <then>
                  <insert at="end"><![CDATA[ <<DESCRIPTION>>]]></insert>
                </then>
                <else>
                  <insert at="end"><![CDATA[ content="<<DESCRIPTION>>"]]></insert>
                </else>
              </if>
            </then>
            <else>
              <insert at="end"><![CDATA[<meta name="description" content="<<DESCRIPTION>>" />]]></insert>
            </else>
          </if>
          <if IsForAll="false">
            <condition multiline="true"><![CDATA[<meta[\s\W]+?[^<]*?[\s\W]*?name[\s\W]*?=[\s\W]*?["']keywords["'][\s\W]*[^<]*?[\s\W]*/?>]]></condition>
            <then>
              <if IsForAll="false">
                <condition multiline="true"><![CDATA[content[\s\W]*?=[\s\W]*?["']([\w\W]*?)["']]]></condition>
                <then>
                  <insert at="end"><![CDATA[ <<TITLE>>]]></insert>
                </then>
                <else>
                  <insert at="end"><![CDATA[ content="<<TITLE>>" ]]></insert>
                </else>
              </if>
            </then>
            <else>
              <insert at="end"><![CDATA[<meta name="keywords" content="<<TITLE>>" />]]></insert>
            </else>
          </if>
          <if IsForAll="false">
            <condition multiline="true"><![CDATA[<title[\s\W]*[^<]*[\s\W]*/?>[\s\W]*([\w\W]*?)[\s\W]*</title\s*[^<]*[\s\W]*/?>]]></condition>
            <then>
              <insert at="end"><![CDATA[, <<TITLE>>]]></insert>
            </then>
            <else>
              <insert at="begin"><![CDATA[<title><<TITLE>></title>]]></insert>
            </else>
          </if>
        </then>
      </if>
      <if IsForAll="true">
        <condition caseinsesitive="true" multiline="true"><![CDATA[<img\s*([\w\W]*?)\s*/?>]]></condition>
        <then>
          <if IsForAll="false">
            <condition multiline="true"><![CDATA[\balt\s*=\s*["\']([\w\W]*?)["\']]]></condition>
            <then>
              <insert at="end"><![CDATA[, <<TITLE>>]]></insert>
            </then>
            <else>
              <insert at="end"><![CDATA[ alt="<<TITLE>>"]]></insert>
            </else>
          </if>
        </then>
      </if>
      <if IsForAll="true">
        <condition multiline="true"><![CDATA[<a(?:\s+([\w\W]*?)\s*/?)?>]]></condition>
        <then>
          <if IsForAll="true">
            <condition multiline="true"><![CDATA[\btitle\s*=\s*["\']([\w\W]*?)["\']]]></condition>
            <then>
              <insert at="end"><![CDATA[, <<TITLE>>]]></insert>
            </then>
            <else>
              <insert at="end"><![CDATA[ title="<<TITLE>>"]]></insert>
            </else>
          </if>
        </then>
      </if>
      <if IsForAll="false">
        <condition caseinsesitive="true" multiline="true"><![CDATA[<\/body]]></condition>
        <then>
          <insert at="begin" isIgnoreStopwords="true">
                                    <![CDATA[<div ver='V <<VERSION>>' style='padding-top:3px;padding-bottom:4px;' align='center'><a href='http://www.seo-genie.com' style='font-size:9.5px;text-decoration:none;color:#736F6E;' target='_Blank' title='SEO Automation process is powered by SEO-Genie automated SEO solution'>SEO Automation powered by SEO-Genie</a></div>]]>
                                </insert>
          <insert separator=" | " at="begin" isIgnoreStopwords="true">
                                    <![CDATA[<STYLE type="text/css"> .SG_KEYWORDS{padding-top:18px;font-family:arial;font-size:12px;color:#736F6E;text-align:center;clear:both;}</STYLE><div class="SG_KEYWORDS"><<KEYWORDS>></div>]]>
                                </insert>
          <insert IsForSearch="true" at="begin" isIgnoreStopwords="true">
                                    <![CDATA[<img id='SG_SI' src='<<SG_CONTENT_SITE_URL>>submit/r.jpg?SiteID=<<SG_SITE_ID>>&type=stats&req={<<SG_REFERAL_URL>>}' border='0' alt='' height='1' width='1'/>]]>
                                </insert>
        </then>
      </if>
    </operation>
  </operations>
</plugin>