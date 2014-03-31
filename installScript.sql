CREATE INDEX FirstNameIndex ON PERSONS(FIRST_NAME) INDEXTYPE IS CTXSYS.CONTEXT;
CREATE INDEX LastNameIndex ON PERSONS(LAST_NAME) INDEXTYPE IS CTXSYS.CONTEXT;
CREATE INDEX DiagnosisIndex ON RADIOLOGY_RECORD(DIAGNOSIS) INDEXTYPE IS CTXSYS.CONTEXT;
CREATE INDEX DescriptionIndex ON RADIOLOGY_RECORD(DESCRIPTION) INDEXTYPE IS CTXSYS.CONTEXT;


declare
    person_id_sequence INTEGER;
    record_id_sequence INTEGER;
    pic_id_sequence INTEGER;
begin
   select max(PERSON_ID) + 1
   into   person_id_sequence
   from   PERSONS;

    execute immediate 'Create sequence person_id_sequence
                       start with ' || person_id_sequence ||
                       ' increment by 1';
                       
   select max(RECORD_ID) + 1
   into   record_id_sequence
   from   RADIOLOGY_RECORD;

    execute immediate 'Create sequence record_id_sequence
                       start with ' || record_id_sequence ||
                       ' increment by 1';

   select max(IMAGE_ID) + 1
   into   pic_id_sequence
   from   PACS_IMAGES;

    execute immediate 'Create sequence pic_id_sequence
                       start with ' || pic_id_sequence ||
                       ' increment by 1';
end;
