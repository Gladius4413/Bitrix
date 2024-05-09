{"version":3,"sources":["base_form.js"],"names":["BX","namespace","append","Landing","Utils","clone","remove","UI","Form","BaseForm","data","this","type","isPlainObject","id","random","selector","title","label","code","descriptionText","description","headerCheckbox","layout","createLayout","fields","Collection","BaseCollection","cards","createDescription","header","createHeader","body","createBody","footer","createFooter","innerHTML","appendChild","sources","Main","getInstance","options","isArray","length","adjustHeaderCheckbox","create","props","className","prototype","form","headerLayout","children","text","innerText","attrs","state","checked","events","change","isFunction","onChange","for","help","click","top","open","bind","undefined","isDynamicEnabled","checkbox","querySelector","addField","field","add","getNode","addCard","card","push","forEach","replaceCard","oldCard","newCard","removeCard","instance","constructor","Field","Date","newFieldData","serialize","result","getValue"],"mappings":"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","file":"base_form.map.js"}