CREATE TABLE public.matiere
(
    id_matiere serial,
    code_matiere integer,
    nom_matiere text,
    PRIMARY KEY (id_matiere),
    CONSTRAINT unique_code_matiere UNIQUE (code_matiere)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE IF EXISTS public.matiere
    OWNER to postgres;