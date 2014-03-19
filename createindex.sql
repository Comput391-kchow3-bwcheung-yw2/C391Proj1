CREATE INDEX TestTypeIndex ON RADIOLOGY_RECORD(TEST_TYPE) INDEXTYPE IS CTXSYS.CONTEXT;
CREATE INDEX DiagnosisIndex ON RADIOLOGY_RECORD(DIAGNOSIS) INDEXTYPE IS CTXSYS.CONTEXT;
CREATE INDEX DescriptionIndex ON RADIOLOGY_RECORD(DESCRIPTION) INDEXTYPE IS CTXSYS.CONTEXT;